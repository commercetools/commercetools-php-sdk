<?php

namespace Commercetools\Core\Response;

use Prophecy\Promise\PromiseInterface;
use GuzzleHttp\Ring\Future\FutureInterface;

interface ApiPromiseGetInterface
{
    /**
     * @return PromiseInterface|FutureInterface Promise
     */
    public function getPromise();
}
