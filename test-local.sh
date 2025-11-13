#!/bin/bash

# Local Test Script for Jenkins Pipeline Security Scans
# This script tests SonarQube and ClamAV scans locally before pushing to Jenkins

set -e

echo "🧪 Testing Jenkins Pipeline Security Scans Locally"
echo "=================================================="

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Check if we're in the right directory
if [ ! -f "Jenkinsfile" ] || [ ! -d "workspace/bagisto" ]; then
    echo -e "${RED}❌ Error: Please run this script from the bagisto-docker directory${NC}"
    echo "Expected files: Jenkinsfile, workspace/bagisto/"
    exit 1
fi

echo "📁 Working directory: $(pwd)"
echo "📦 Source directory: workspace/bagisto"
echo ""

# Test 1: SonarQube Scanner (Jenkins paths)
echo "📊 Test 1: SonarQube Scanner (Jenkins paths)"
echo "--------------------------------------------"

# Test Jenkins paths (what we just fixed)
SONAR_SOURCES_JENKINS="app packages/Webkul"
echo "🔍 Jenkins SonarQube sources: $SONAR_SOURCES_JENKINS"

TOTAL_FILES_JENKINS=0
for src in $SONAR_SOURCES_JENKINS; do
    if [ -d "workspace/bagisto/$src" ]; then
        FILE_COUNT=$(find "workspace/bagisto/$src" -name "*.php" | wc -l)
        echo "📁 workspace/bagisto/$src: $FILE_COUNT PHP files"
        TOTAL_FILES_JENKINS=$((TOTAL_FILES_JENKINS + FILE_COUNT))
    else
        echo -e "${YELLOW}⚠️  Directory workspace/bagisto/$src not found${NC}"
    fi
done

echo "📊 Total PHP files for Jenkins SonarQube: $TOTAL_FILES_JENKINS"

if [ $TOTAL_FILES_JENKINS -gt 0 ]; then
    echo -e "${GREEN}✅ Jenkins SonarQube should detect $TOTAL_FILES_JENKINS+ files${NC}"
else
    echo -e "${RED}❌ Jenkins SonarQube will detect 0 files - check paths!${NC}"
fi

echo ""

# Test 2: ClamAV Scanner (Jenkins paths)
echo "🦠 Test 2: ClamAV Scanner (Jenkins paths)"
echo "-----------------------------------------"

CLAMAV_TARGET_JENKINS="workspace/bagisto"
echo "🔍 Jenkins ClamAV scan target: $CLAMAV_TARGET_JENKINS"

if [ -d "$CLAMAV_TARGET_JENKINS" ]; then
    # Count total files (excluding vendor and node_modules) - same as Jenkins
    TOTAL_SCAN_FILES_JENKINS=$(find "$CLAMAV_TARGET_JENKINS" -type f \
        -not -path "*/vendor/*" \
        -not -path "*/node_modules/*" \
        -not -path "*/.git/*" | wc -l)

    echo "📁 Files to scan: $TOTAL_SCAN_FILES_JENKINS"

    if [ $TOTAL_SCAN_FILES_JENKINS -gt 0 ]; then
        echo -e "${GREEN}✅ Jenkins ClamAV should scan $TOTAL_SCAN_FILES_JENKINS+ files${NC}"
    else
        echo -e "${RED}❌ Jenkins ClamAV will scan 0 files - check paths!${NC}"
    fi
else
    echo -e "${RED}❌ Jenkins ClamAV target directory not found${NC}"
fi

echo ""

# Test 3: Docker Image Build Test
echo "🐳 Test 3: Docker Build Test"
echo "----------------------------"

echo "🔨 Testing Docker build (build stage only)..."
if docker build --target build -t bagisto-test-build -f Dockerfile . >/dev/null 2>&1; then
    echo -e "${GREEN}✅ Docker build successful${NC}"

    # Test PHPUnit inside container
    echo "🧪 Testing PHPUnit inside container..."
    if docker run --rm bagisto-test-build sh -c 'cd /var/www/html && vendor/bin/pest tests/Unit --stop-on-failure' >/dev/null 2>&1; then
        echo -e "${GREEN}✅ PHPUnit tests passed${NC}"
    else
        echo -e "${YELLOW}⚠️  PHPUnit tests failed (check output above)${NC}"
    fi

    # Test Composer Audit inside container
    echo "🔍 Testing Composer audit inside container..."
    AUDIT_OUTPUT=$(docker run --rm bagisto-test-build sh -c 'cd /var/www/html && composer audit --no-dev || true' 2>/dev/null)
    if echo "$AUDIT_OUTPUT" | grep -q "security vulnerability advisories found"; then
        if echo "$AUDIT_OUTPUT" | grep -E "Severity: (moderate|high|critical)" >/dev/null; then
            echo -e "${RED}❌ Composer audit found vulnerabilities${NC}"
        else
            echo -e "${YELLOW}⚠️  Composer audit found low-severity issues${NC}"
        fi
    else
        echo -e "${GREEN}✅ Composer audit passed${NC}"
    fi

    # Cleanup
    docker rmi bagisto-test-build >/dev/null 2>&1 || true

else
    echo -e "${RED}❌ Docker build failed${NC}"
fi

echo ""
echo "🎯 Summary"
echo "=========="
echo "If all tests above are green ✅, then Jenkins should work correctly."
echo ""
echo "Next steps:"
echo "1. If tests pass: git push origin main"
echo "2. If tests fail: Fix the issues and re-run this script"
echo ""
echo "Jenkins will poll every 15 minutes, or you can trigger manually."