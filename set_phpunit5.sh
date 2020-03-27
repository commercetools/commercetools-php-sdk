#!/bin/bash
SRC='"phpunit/phpunit": "^8.5"'
DST='"phpunit/phpunit": "^5.7.21"'
sed -ibak -e "s|$SRC|$DST|g" composer.json
