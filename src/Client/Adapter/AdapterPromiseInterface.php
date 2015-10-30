<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Client\Adapter;

use Psr\Http\Message\ResponseInterface;

interface AdapterPromiseInterface extends ResponseInterface
{
    /**
     * @param callable $onFulfilled
     * @param callable $onRejected
     * @return AdapterPromiseInterface
     */
    public function then(callable $onFulfilled = null, callable $onRejected = null);

    /**
     * @return mixed
     */
    public function wait();
}
