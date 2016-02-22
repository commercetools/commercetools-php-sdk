#!/bin/sh
set -e

service redis-server start

composer -n run-script updateConfig

vendor/bin/phpunit "$@"
