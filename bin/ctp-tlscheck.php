#!/usr/bin/env php
<?php

class Tls12Checker
{
    public function allowedCiphers()
    {
        return [
            'TLS_ECDHE_RSA_WITH_AES_128_GCM_SHA256',
            'TLS_ECDHE_RSA_WITH_CHACHA20_POLY1305_SHA256',
            'TLS_ECDHE_RSA_WITH_AES_256_GCM_SHA384',
            'TLS_ECDHE_RSA_WITH_AES_128_CBC_SHA',
            'TLS_ECDHE_RSA_WITH_AES_256_CBC_SHA'
        ];
    }

    /**
     * @return array
     * @throws \Exception
     */
    private function getSupportedCiphers()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.howsmyssl.com/a/check");
        curl_setopt($ch, CURLOPT_SSLVERSION, 6);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $tlsInfo = json_decode($response, true);

        if ($response === false) {
            throw new \Exception('Connection not connect using TLS 1.2', 1);
        }

        return isset($tlsInfo['given_cipher_suites']) ? $tlsInfo['given_cipher_suites'] : [];
    }

    /**
     * @throws \Exception
     */
    private function checkCiphers()
    {
        $supportedCiphers = $this->getSupportedCiphers();
        $allowedCiphers = $this->allowedCiphers();

        $diff = array_diff($allowedCiphers, $supportedCiphers);

        if (count($diff) < count($allowedCiphers)) {
            return;
        };
        throw new \Exception('None of the allowed cipher suites are supported: ' . implode(', ', $allowedCiphers), 1);
    }

    /**
     * @throws \Exception
     */
    private function checkApiConnection()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.escemo.com");
        curl_setopt($ch, CURLOPT_SSLVERSION, 6);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        if ($response === false) {
            throw new \Exception('Could not connect not connect to API using TLS 1.2', 1);
        }
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        $this->checkCiphers();
        $this->checkApiConnection();
    }
}

$checker = new Tls12Checker();

echo "Checking TLS 1.2 connection ... ";
try {
    $checker->check();
} catch (\Exception $exception) {
    echo "\033[31mFailed\033[0m" . PHP_EOL;
    echo $exception->getMessage() . PHP_EOL;
    exit($exception->getCode());
}

echo "\033[32mOK\033[0m" . PHP_EOL;
