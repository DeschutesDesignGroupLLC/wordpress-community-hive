#!/bin/bash

SOURCE_DIR="src"
VENDOR_DIR="vendor"
PLUGIN_FILE="communityhive.php"
ZIP_FILE="communityhive.zip"

# Delete existing build
if [ -f "./build/$ZIP_FILE" ]; then
  rm -r ./build/$ZIP_FILE
fi

# Move source over to build directory
if [ ! -d "./build/$SOURCE_DIR" ]; then
  cp -r $SOURCE_DIR build/
fi

if [ ! -d "./build/$VENDOR_DIR" ]; then
  cp -r $VENDOR_DIR build/
fi

if [ ! -f "./build/$PLUGIN_FILE" ]; then
  cp -r $PLUGIN_FILE build/
fi

if [ ! -f "./build/composer.json" ]; then
  cp -r composer.json build/
fi

# Change to build directory
cd build

# Update the autoloader to PHP-Scoper
sed -i '' 's/\/autoload.php/\/scoper-autoload.php/g;' communityhive.php

# Remove all files from the storage directories
rm -rf src/storage/framework/cache/*
rm -rf src/storage/framework/sessions/*
rm -rf src/storage/framework/views/*

# Create the zip archive, ignoring any log files or env variables
zip -r $ZIP_FILE * -x '*.log' '*.env'

# Clean up files
rm -r $SOURCE_DIR
rm -r $VENDOR_DIR
rm -r $PLUGIN_FILE
rm -r composer.json

echo "Package complete."