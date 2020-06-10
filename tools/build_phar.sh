#!/usr/local/bin/bash

tools/box compile
gpg -u 8B4055F0ED004102F295C3BD01263CCEE8010A56 --yes --detach-sign --output commercetools-php-sdk.phar.asc commercetools-php-sdk.phar
gpg --verify commercetools-php-sdk.phar.asc commercetools-php-sdk.phar
