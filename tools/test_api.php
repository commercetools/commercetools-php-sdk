#!/usr/bin/env php
<?php

$authUri = $_SERVER['COMMERCETOOLS_OAUTH_URL'] . '/oauth/token';

$clientId = $_SERVER['COMMERCETOOLS_CLIENT_ID'];
$clientSecret = $_SERVER['COMMERCETOOLS_CLIENT_SECRET'];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $authUri);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Basic ' . base64_encode($clientId . ':' . $clientSecret),
    'Content-Type: application/x-www-form-urlencoded'
]);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$res = curl_exec($ch);
curl_close($ch);

$res = json_decode($res, true);
$token = $res['access_token'];

$project = $_SERVER['COMMERCETOOLS_PROJECT'];
$uri = $_SERVER['COMMERCETOOLS_API_URL'] . '/' . $project;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $uri);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $token
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
