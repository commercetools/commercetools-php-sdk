#!/bin/bash
SRC='"guzzlehttp/guzzle": "^7.0 \|\| ^6.0"'
DST='"guzzlehttp/guzzle": "^5.3.3", "react/promise": "^2.2.0", "guzzlehttp/ringphp": "^1.1.1"'
sed -ibak -e "s|$SRC|$DST|g" composer.json
