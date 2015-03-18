<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Categories;


use Sphere\Core\RequestTestCase;

class CategoryDeleteByIdRequestTest extends RequestTestCase
{
    const CATEGORY_DELETE_BY_ID_REQUEST = '\Sphere\Core\Request\Categories\CategoryDeleteByIdRequest';

    public function testMapResult()
    {
        $result = $this->mapResult(static::CATEGORY_DELETE_BY_ID_REQUEST, ['id', 1]);
        $this->assertInstanceOf('\Sphere\Core\Model\Category\Category', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(static::CATEGORY_DELETE_BY_ID_REQUEST, ['id', 1]);
        $this->assertNull($result);
    }
}
