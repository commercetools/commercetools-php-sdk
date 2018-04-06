#!/bin/sh
set -e
export PATH="/usr/local/bin:$PATH"
node tools/validate-commit-msg.js $1
