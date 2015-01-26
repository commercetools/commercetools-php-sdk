<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 23.01.15, 15:58
 */

namespace Sphere\Core\Http;


interface HttpRequestInterface extends ClientRequest
{
    /**
     * @return string
     */
    public function getHttpMethod();

    /**
     * @return string
     */
    public function getPath();

    /**
     * @return string
     */
    public function getBody();

    /**
     * @return array
     */
    public function getHeaders();
}
