<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Client\Adapter;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;

interface AdapterInterface extends LoggerAwareInterface
{
    public function setLogger(LoggerInterface $logger);

    public function addHandler($handler);

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
    public function executeAsync(RequestInterface $request);

    /**
     * returns used HTTP Client and version
     * @return string
     */
    public static function getAdapterInfo();
}
