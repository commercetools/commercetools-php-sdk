<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CustomObjects;


use Sphere\Core\Model\CustomObject\CustomObject;
use Sphere\Core\RequestTestCase;

/**
 * Class CustomObjectCreateRequestTest
 * @package Sphere\Core\Request\CustomObjects
 */
class CustomObjectCreateRequestTest extends RequestTestCase
{
    const CUSTOM_OBJECT_CREATE_REQUEST = '\Sphere\Core\Request\CustomObjects\CustomObjectCreateRequest';

    public function getObject()
    {
        return new CustomObject();
    }

    public function testMapResult()
    {
        $result = $this->mapResult(static::CUSTOM_OBJECT_CREATE_REQUEST, [$this->getObject()]);
        $this->assertInstanceOf('\Sphere\Core\Model\CustomObject\CustomObject', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(static::CUSTOM_OBJECT_CREATE_REQUEST, [$this->getObject()]);
        $this->assertNull($result);
    }
}
