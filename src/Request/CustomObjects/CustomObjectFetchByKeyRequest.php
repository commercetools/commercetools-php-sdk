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
 * @link http://dev.sphere.io/http-api-projects-custom-objects.html#custom-object-by-container-and-key
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
