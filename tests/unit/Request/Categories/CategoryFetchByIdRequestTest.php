<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Categories;


use Sphere\Core\RequestTestCase;

class CategoryFetchByIdRequestTest extends RequestTestCase
{
    const CATEGORY_FETCH_BY_ID_REQUEST = '\Sphere\Core\Request\Categories\CategoryFetchByIdRequest';

    public function testMapResult()
    {
        $result = $this->mapResult(static::CATEGORY_FETCH_BY_ID_REQUEST, ['id']);
        $this->assertInstanceOf('\Sphere\Core\Model\Category\Category', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(static::CATEGORY_FETCH_BY_ID_REQUEST, ['id']);
        $this->assertNull($result);
    }
}
