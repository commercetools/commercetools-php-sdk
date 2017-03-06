#!/bin/sh
set -e

composer -n update --prefer-dist -o
vendor/bin/phpunit "$@"
