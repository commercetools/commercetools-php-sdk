#!/bin/sh
set -e

service redis-server start

composer run-script updateConfig

vendor/bin/phpunit "$@"
