#!/usr/bin/env php
<?php

require __DIR__ . '/../vendor/autoload.php';

$checker = new \Commercetools\Core\Helper\Tls12Checker();

echo "Checking TLS 1.2 connection ... ";
try {
    $checker->check();
} catch (\Exception $exception) {
    echo "\033[31mFailed\033[0m" . PHP_EOL;
    echo $exception->getMessage() . PHP_EOL;
    exit($exception->getCode());
}

echo "\033[32mOK\033[0m" . PHP_EOL;
