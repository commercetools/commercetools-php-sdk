<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CustomObjects;


use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Model\CustomObject\CustomObject;
use Sphere\Core\RequestTestCase;

/**
 * Class CustomObjectDeleteByKeyRequestTest
 * @package Sphere\Core\Request\CustomObjects
 */
class CustomObjectDeleteByKeyRequestTest extends RequestTestCase
{
    const CUSTOM_OBJECT_DELETE_REQUEST = '\Sphere\Core\Request\CustomObjects\CustomObjectDeleteByKeyRequest';

    public function getObject()
    {
        return new CustomObject();
    }

    public function testMapResult()
    {
        $result = $this->mapResult(static::CUSTOM_OBJECT_DELETE_REQUEST, ['my-namespace', 'my-key']);
        $this->assertInstanceOf('\Sphere\Core\Model\CustomObject\CustomObject', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(static::CUSTOM_OBJECT_DELETE_REQUEST, ['my-namespace', 'my-key']);
        $this->assertNull($result);
    }

    public function testHttpRequestMethod()
    {
        $request = $this->getRequest(static::CUSTOM_OBJECT_DELETE_REQUEST, ['my-namespace', 'my-key']);
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::DELETE, $httpRequest->getMethod());
    }
}
