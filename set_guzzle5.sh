#!/bin/bash
SRC='"guzzlehttp/guzzle": "^6.0"'
DST='"guzzlehttp/guzzle": "^5.0", "guzzlehttp/log-subscriber": "^1.0"'
sed -ibak -e "s|$SRC|$DST|g" composer.json
