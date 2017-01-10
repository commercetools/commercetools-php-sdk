<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CustomObjects;

use Commercetools\Core\Model\CustomObject\CustomObject;
use Commercetools\Core\Model\CustomObject\CustomObjectDraft;
use Commercetools\Core\RequestTestCase;

/**
 * Class CustomObjectCreateRequestTest
 * @package Commercetools\Core\Request\CustomObjects
 */
class CustomObjectCreateRequestTest extends RequestTestCase
{
    const CUSTOM_OBJECT_CREATE_REQUEST = '\Commercetools\Core\Request\CustomObjects\CustomObjectCreateRequest';

    public function getObject()
    {
        return new CustomObjectDraft();
    }

    public function testMapResult()
    {
        $result = $this->mapResult(CustomObjectCreateRequest::ofObject($this->getObject()));
        $this->assertInstanceOf(CustomObject::class, $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(CustomObjectCreateRequest::ofObject($this->getObject()));
        $this->assertNull($result);
    }
}
