<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CustomObjects;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Client\HttpRequest;
use Commercetools\Core\Model\CustomObject\CustomObject;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\CustomObjects
 * @link https://dev.commercetools.com/http-api-projects-custom-objects.html#delete-custom-object-by-container-and-key
 * @method CustomObject mapResponse(ApiResponseInterface $response)
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
