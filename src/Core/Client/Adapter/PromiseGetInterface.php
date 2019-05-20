<?php

namespace Commercetools\Core\Client\Adapter;

use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Ring\Future\FutureInterface;

interface PromiseGetInterface
{
    /**
     * @return PromiseInterface|FutureInterface Promise
     */
    public function getPromise();
}
