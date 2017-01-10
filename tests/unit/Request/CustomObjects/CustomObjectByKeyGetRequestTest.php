<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CustomObjects;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Model\CustomObject\CustomObject;
use Commercetools\Core\RequestTestCase;

/**
 * Class CustomObjectByKeyGetRequestTest
 * @package Commercetools\Core\Request\CustomObjects
 */
class CustomObjectByKeyGetRequestTest extends RequestTestCase
{
    const CUSTOM_OBJECT_GET_REQUEST = '\Commercetools\Core\Request\CustomObjects\CustomObjectByKeyGetRequest';

    public function getObject()
    {
        return new CustomObject();
    }

    public function testMapResult()
    {
        $result = $this->mapResult(CustomObjectByKeyGetRequest::ofContainerAndKey('my-namespace', 'my-key'));
        $this->assertInstanceOf(CustomObject::class, $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(CustomObjectByKeyGetRequest::ofContainerAndKey('my-namespace', 'my-key'));
        $this->assertNull($result);
    }

    public function testHttpRequestMethod()
    {
        $request = CustomObjectByKeyGetRequest::ofContainerAndKey('my-namespace', 'my-key');
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::GET, $httpRequest->getMethod());
    }
}
