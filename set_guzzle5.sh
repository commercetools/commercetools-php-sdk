#!/bin/bash
SRC='"guzzlehttp/guzzle": "^6.0"'
DST='"guzzlehttp/guzzle": "^5.3.3", "react/promise": "^2.2.0"'
sed -ibak -e "s|$SRC|$DST|g" composer.json
