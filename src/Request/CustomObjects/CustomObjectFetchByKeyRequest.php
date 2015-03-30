<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CustomObjects;


use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Client\HttpRequest;

/**
 * Class CustomObjectFetchByKeyRequest
 * @package Sphere\Core\Request\CustomObjects
 */
class CustomObjectFetchByKeyRequest extends AbstractCustomObjectRequest
{
    /**
     * @return HttpRequest
     * @internal
     */
    public function httpRequest()
    {
        return new HttpRequest(HttpMethod::GET, $this->getPath());
    }
}
