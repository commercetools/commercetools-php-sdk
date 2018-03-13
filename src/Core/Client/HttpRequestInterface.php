<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 23.01.15, 15:58
 */

namespace Commercetools\Core\Client;

/**
 * Interface HttpRequestInterface
 * @package Commercetools\Core\Http
 */
interface HttpRequestInterface
{
    /**
     * @return string
     * @internal
     */
    public function getHttpMethod();

    /**
     * @return string
     * @internal
     */
    public function getPath();

    /**
     * @return string
     * @internal
     */
    public function getBody();

    /**
     * @return array
     * @internal
     */
    public function getHeaders();
}
