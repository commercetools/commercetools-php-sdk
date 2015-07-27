<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CustomObjects;


use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Model\CustomObject\CustomObject;
use Sphere\Core\RequestTestCase;

/**
 * Class CustomObjectByKeyGetRequestTest
 * @package Sphere\Core\Request\CustomObjects
 */
class CustomObjectByKeyGetRequestTest extends RequestTestCase
{
    const CUSTOM_OBJECT_GET_REQUEST = '\Sphere\Core\Request\CustomObjects\CustomObjectByKeyGetRequest';

    public function getObject()
    {
        return new CustomObject();
    }

    public function testMapResult()
    {
        $result = $this->mapResult(CustomObjectByKeyGetRequest::ofContainerAndKey('my-namespace', 'my-key'));
        $this->assertInstanceOf('\Sphere\Core\Model\CustomObject\CustomObject', $result);
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
