#!/bin/sh
set -e

service redis-server start

composer -n update --prefer-dist -o
vendor/bin/phpunit "$@"
