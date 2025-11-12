# 🚀 Unified Docker Setup - Best Practices

## 📋 Philosophy

This setup follows CI/CD best practices:
- ✅ **Single Dockerfile** with multi-stage builds (dev/prod)
- ✅ **Single docker-compose** with environment-specific `.env` files
- ✅ **Version-controlled deployments** (no more `latest` deployment)
- ✅ **Layer caching optimization** (dependencies → assets → code)

---

## 🏗️ Architecture

```
Dockerfile:
  ├── base        → Common PHP + extensions
  ├── dependencies → Composer + npm install (CACHED)
  ├── development → + Xdebug, volume mounting
  ├── builder     → Build assets
  └── production  → Optimized, no dev tools
```

---

## 🔧 Usage

### Development (Local)
```bash
# Use development environment
docker-compose --env-file .env.dev up

# Code is mounted from ./workspace/bagisto (hot reload)
# Xdebug enabled on port 9003
```

### Production (Deployment)
```bash
# Use production environment
docker-compose --env-file .env.prod up -d

# Code is baked into image (no volume mount)
# Optimized for performance
```

### CI/CD Testing
```bash
# Build and test with EXACT production target
docker build --target production -t bagisto:test -f Dockerfile .
docker run bagisto:test vendor/bin/pest
```

---

## 📦 Build Strategy

### Layer Caching (Fast Rebuilds)
```
Layer 1: Base image + PHP extensions     ← Rarely changes
Layer 2: Dependencies (composer + npm)   ← Changes occasionally
Layer 3: Assets build                    ← Changes sometimes
Layer 4: Source code                     ← Changes frequently
```

**Result:**
- Change code only → Rebuild layer 4 (~30s)
- Change dependencies → Rebuild layers 2-4 (~5min)
- Change Dockerfile → Full rebuild (~10min)

---

## 🎯 Version Control

### Before (WRONG ❌)
```groovy
docker push bao110304/bagisto:220-abc123   // Build specific version
docker pull bao110304/bagisto:latest       // Deploy different version!
```

### After (CORRECT ✅)
```groovy
docker push bao110304/bagisto:220-abc123   // Build version
docker pull bao110304/bagisto:220-abc123   // Deploy SAME version
```

**Benefits:**
- ✅ Know exactly what's deployed
- ✅ Easy rollback to any previous version
- ✅ Deployment audit trail

---

## 🔄 Rollback

```bash
# View deployment history
ssh root@vps 'cat /var/log/bagisto-deployments.log'

# Rollback to specific version
ssh root@vps 'cd /root/bagisto && \
  sed -i "s|image: .*|image: bao110304/bagisto:219-xyz789|" docker-compose.yml && \
  docker-compose up -d'
```

---

## 📊 Environment Variables

| Variable | Dev | Prod | Description |
|----------|-----|------|-------------|
| BUILD_TARGET | development | production | Which stage to build |
| SOURCE_MOUNT | ./workspace | (empty) | Mount code or not |
| APP_DEBUG | true | false | Debug mode |
| DOCKER_IMAGE | bagisto:dev | bao110304/bagisto:TAG | Image to use |

---

## 🚨 Migration Guide

### Old Files (DELETED ✅)
- ❌ `Dockerfile.ci`
- ❌ `deploy/Dockerfile.production`
- ❌ `docker-compose.production.yml`

### New Files (ACTIVE ✅)
- ✅ `Dockerfile` (unified with multi-stage)
- ✅ `docker-compose.yml` (unified)
- ✅ `.env.dev`
- ✅ `.env.prod`

---

## 📝 Best Practices Applied

1. **Environment Parity**: Dev, CI, Prod use SAME Dockerfile
2. **Configuration Management**: Separate code from config (.env files)
3. **Version Control**: Deploy specific versions, not `latest`
4. **Build Optimization**: Layer caching minimizes rebuild time
5. **Rollback Capability**: Easy to revert to any previous version

---

## 🎓 Learn More

- [12-Factor App](https://12factor.net/)
- [Docker Multi-Stage Builds](https://docs.docker.com/build/building/multi-stage/)
- [Docker Layer Caching](https://docs.docker.com/build/cache/)
