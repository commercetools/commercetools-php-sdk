#!/bin/bash
SRC='"guzzlehttp/guzzle": "~6.0"'
DST='"guzzlehttp/guzzle": "~5.0"'
sed -i .bak -e "s|$SRC|$DST|g" composer.json
