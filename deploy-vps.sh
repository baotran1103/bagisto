#!/bin/bash

# VPS Deployment Script for Bagisto
# Usage: ./deploy-vps.sh [tag]
# Example: ./deploy-vps.sh 165-a1b2c3d  (or leave empty for 'latest')

set -e

VPS_HOST="139.180.218.27"
VPS_USER="root"
IMAGE_TAG="${1:-latest}"
DOCKER_IMAGE="bao110304/bagisto:${IMAGE_TAG}"

echo "🚀 Deploying Bagisto to VPS ${VPS_HOST}"
echo "📦 Image: ${DOCKER_IMAGE}"

# Copy docker-compose file to VPS
echo "📤 Uploading docker-compose.production.yml..."
scp docker-compose.production.yml ${VPS_USER}@${VPS_HOST}:/root/bagisto/

# Deploy on VPS
echo "🔄 Deploying on VPS..."
ssh ${VPS_USER}@${VPS_HOST} << EOF
  set -e
  cd /root/bagisto
  
  # Pull latest image
  echo "⬇️  Pulling Docker image..."
  docker pull ${DOCKER_IMAGE}
  
  # Update docker-compose to use specific tag
  sed -i "s|image: bao110304/bagisto:.*|image: ${DOCKER_IMAGE}|g" docker-compose.production.yml
  
  # Stop old containers
  echo "🛑 Stopping old containers..."
  docker-compose -f docker-compose.production.yml down || true
  
  # Start new containers
  echo "▶️  Starting new containers..."
  docker-compose -f docker-compose.production.yml up -d
  
  # Wait for services
  echo "⏳ Waiting for services to be ready..."
  sleep 10
  
  # Run migrations (only on first deploy or when needed)
  echo "🔧 Running migrations..."
  docker-compose -f docker-compose.production.yml exec -T bagisto php artisan migrate --force || echo "⚠️  Migrations skipped or failed"
  
  # Clear cache
  echo "🧹 Clearing cache..."
  docker-compose -f docker-compose.production.yml exec -T bagisto php artisan cache:clear || true
  docker-compose -f docker-compose.production.yml exec -T bagisto php artisan config:clear || true
  docker-compose -f docker-compose.production.yml exec -T bagisto php artisan route:clear || true
  
  # Check status
  echo "✅ Deployment status:"
  docker-compose -f docker-compose.production.yml ps
  
  # Cleanup old images
  echo "🧹 Cleaning up old images..."
  docker image prune -f
EOF

echo ""
echo "═══════════════════════════════════════"
echo "✅ Deployment Complete!"
echo "═══════════════════════════════════════"
echo "🌐 Application URL: http://${VPS_HOST}"
echo "📦 Image deployed: ${DOCKER_IMAGE}"
echo ""
echo "Useful commands on VPS:"
echo "  docker-compose -f docker-compose.production.yml logs -f bagisto"
echo "  docker-compose -f docker-compose.production.yml ps"
echo "  docker-compose -f docker-compose.production.yml restart"
echo "═══════════════════════════════════════"
