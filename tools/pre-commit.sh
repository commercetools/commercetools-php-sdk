#!/bin/sh
set -e
export PATH="/usr/local/bin:$PATH"
php vendor/bin/phpunit --configuration phpunit.xml.dist --testsuite=unit
php vendor/bin/phpcs --standard=PSR2 --extensions=php -p --ignore=autoload.php src
