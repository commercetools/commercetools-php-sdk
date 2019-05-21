<?php

namespace Commercetools\Core\Response;

use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Ring\Future\FutureInterface;

interface ApiPromiseGetInterface
{
    /**
     * @return PromiseInterface|FutureInterface Promise
     */
    public function getPromise();
}
