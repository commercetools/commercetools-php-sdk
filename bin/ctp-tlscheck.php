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
        throw new \Exception('None of the allowed cipher suites are supported by curl: ' . implode(', ', $allowedCiphers), 1);
    }

    /**
     * @throws \Exception
     */
    private function checkApiConnection($cipher = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.escemo.com");
        curl_setopt($ch, CURLOPT_SSLVERSION, 6);
        if (!is_null($cipher)) {
            curl_setopt($ch, CURLOPT_SSL_CIPHER_LIST, $cipher);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        if ($response == false) {
            throw new \Exception('Could not connect not connect to API using TLS 1.2' . (is_null($cipher) ? '' : ' with cipher ' . $cipher), 1);
        }
    }

    private function checkCurlVersion()
    {
        $curlVersion = curl_version();
        $supportsTLS12 = true;
        if (version_compare(curl_version()['version'], '7.34.0', '<')) {
            $supportsTLS12 = false;
        }
        echo 'Curl version: ' . ($supportsTLS12 ? "\033[32m" : "\033[31m") . curl_version()['version'] . "\033[0m" . ($supportsTLS12 ? '' : '(TLS 1.2 not supported)') . PHP_EOL;

        if (isset($curlVersion['ssl_version'])) {
            echo 'Curl SSL Library: ' . curl_version()['ssl_version'] . PHP_EOL;
        }
    }

    /**
     * @return int
     */
    public function check()
    {
        $this->checkCurlVersion();

        echo "Checking TLS 1.2 connection ... ";
        try {
            $this->checkCiphers();
            $this->checkApiConnection();
        } catch (\Exception $exception) {
            echo "\033[31mFailed\033[0m" . PHP_EOL;
            echo $exception->getMessage() . PHP_EOL;
            return (int)$exception->getCode();
        }

        echo "\033[32mOK\033[0m" . PHP_EOL;

        return 0;
    }

    private function availableCiphers()
    {
        $localCiphers = explode(' ', exec('openssl ciphers \'ALL:eNULL\' | tr \':\' \' \''));
        $allowedCiphers = [];
        foreach ($localCiphers as $localCipher) {
            exec('echo -n | openssl s_client -connect api.escemo.com:443 -cipher ' . $localCipher . ' -tls1_2 2>&1', $dummy, $status);
            if ($status === 0) {
                $allowedCiphers[] = $localCipher;
            }
        }

        return $allowedCiphers;
    }

    private function checkAvailableCiphers()
    {
        $availableCiphers = $this->availableCiphers();
        foreach ($availableCiphers as $cipher) {
            echo 'Testing ' . $cipher . '...';
            try {
                $this->checkApiConnection($cipher);
                echo "\033[32mOK\033[0m" . PHP_EOL;
            } catch (\Exception $exception) {
                echo "\033[31mFailed\033[0m" . PHP_EOL;
            }
        }
    }
}

$checker = new Tls12Checker();
exit($checker->check());
