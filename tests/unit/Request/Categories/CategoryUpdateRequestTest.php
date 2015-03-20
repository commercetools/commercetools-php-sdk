<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Categories;


use Sphere\Core\RequestTestCase;

class CategoryUpdateRequestTest extends RequestTestCase
{
    const CATEGORY_UPDATE_REQUEST = '\Sphere\Core\Request\Categories\CategoryUpdateRequest';

    public function testMapResult()
    {
        $result = $this->mapResult(static::CATEGORY_UPDATE_REQUEST, ['id', 1]);
        $this->assertInstanceOf('\Sphere\Core\Model\Category\Category', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(static::CATEGORY_UPDATE_REQUEST, ['id', 1]);
        $this->assertNull($result);
    }
}
