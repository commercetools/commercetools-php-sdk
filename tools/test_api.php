#!/usr/bin/env php
<?php

$uri = $_SERVER['COMMERCETOOLS_API_URL'];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $uri);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$retry = 60;

echo 'Testing connection (' . $uri . ') ';
do {
    sleep(2);
    $res = curl_exec($ch);
    $status = curl_getinfo($ch);
    $retry--;
    echo '.';
} while ($status['http_code'] !== 200 && $retry > 0);

curl_close($ch);
if ($status['http_code'] == 200) {
    echo 'success' . PHP_EOL;
    exit(0);
}

echo 'could not establish connection' . PHP_EOL;
exit(1);
