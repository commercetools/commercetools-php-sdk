<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CustomObjects;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Client\HttpRequest;
use Commercetools\Core\Model\CustomObject\CustomObject;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\CustomObjects
 * @link https://docs.commercetools.com/http-api-projects-custom-objects.html#delete-customobject-by-container-and-key
 * @method CustomObject mapResponse(ApiResponseInterface $response)
 * @method CustomObject mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class CustomObjectDeleteByKeyRequest extends AbstractCustomObjectRequest
{
    /**
     * @return HttpRequest
     * @internal
     */
    public function httpRequest()
    {
        return new HttpRequest(HttpMethod::DELETE, $this->getPath());
    }
}
