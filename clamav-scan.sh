#!/bin/bash

# ClamAV Scan Script for Docker Environment

echo "=== ClamAV Virus Scan ==="
echo "Scanning directories for viruses..."

# Function to scan a directory
scan_directory() {
    local dir=$1
    local name=$2
    
    echo ""
    echo "Scanning $name directory: $dir"
    echo "----------------------------------------"
    
    echo "Starting ClamAV scan for $name..."
    # Use clamdscan with TCP connection to daemon
    docker-compose exec clamav clamdscan --multiscan --fdpass "$dir"
}

# Check if ClamAV services are running
echo "Checking ClamAV services..."
if ! docker-compose ps clamav | grep -q "Up"; then
    echo "Starting ClamAV daemon..."
    docker-compose up -d clamav
    
    echo "Waiting for ClamAV to initialize..."
    sleep 10
fi

# Scan workspace (Bagisto)
scan_directory "/scan/workspace" "Bagisto Workspace"

# Scan training management system
scan_directory "/scan/training" "Training Management System"

# Scan uploaded files directory if exists
if [ -d "/scan/workspace/storage/app/public" ]; then
    scan_directory "/scan/workspace/storage/app/public" "Uploaded Files"
fi

echo ""
echo "=== Scan Complete ==="
echo "Check the output above for any virus detections."
echo "If viruses are found, they will be listed with FOUND marker."
echo ""
echo "To update virus definitions manually:"
echo "docker-compose exec clamav freshclam"
