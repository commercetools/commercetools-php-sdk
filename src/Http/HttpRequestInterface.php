<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 23.01.15, 15:58
 */

namespace Sphere\Core\Http;


/**
 * Interface HttpRequestInterface
 * @package Sphere\Core\Http
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
