<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Client\Adapter;


use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface AdapterInterface
{
    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function execute(RequestInterface $request);

    /**
     * @param RequestInterface[] $requests
     * @return ResponseInterface[]
     */
    public function executeBatch(array $requests);

    /**
     * @param $oauthUri
     * @param $clientId
     * @param $clientSecret
     * @param $formParams
     * @return ResponseInterface
     */
    public function authenticate($oauthUri, $clientId, $clientSecret, $formParams);

    /**
     * @param RequestInterface $request
     * @return AdapterPromiseInterface
     */
    public function future(RequestInterface $request);
}
