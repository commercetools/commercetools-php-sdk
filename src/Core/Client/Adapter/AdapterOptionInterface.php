<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Client\Adapter;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface AdapterOptionInterface extends AdapterInterface
{
    /**
     * @param RequestInterface $request
     * @param array $clientOptions
     * @return ResponseInterface
     */
    public function execute(RequestInterface $request, array $clientOptions = []);

    /**
     * @param RequestInterface[] $requests
     * @param array $clientOptions
     * @return ResponseInterface[]
     */
    public function executeBatch(array $requests, array $clientOptions = []);

    /**
     * @param RequestInterface $request
     * @param array $clientOptions
     * @return AdapterPromiseInterface
     */
    public function executeAsync(RequestInterface $request, array $clientOptions = []);
}
