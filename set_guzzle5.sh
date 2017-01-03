#!/bin/bash
SRC='"guzzlehttp/guzzle": "^6.0"'
DST='"guzzlehttp/guzzle": "^5.3.1", "guzzlehttp/log-subscriber": "^1.0", "guzzlehttp/ringphp": "^1.0.7"'
sed -ibak -e "s|$SRC|$DST|g" composer.json
