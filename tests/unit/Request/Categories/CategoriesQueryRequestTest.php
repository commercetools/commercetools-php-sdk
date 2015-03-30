<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Categories;


use Sphere\Core\RequestTestCase;

class CategoriesQueryRequestTest extends RequestTestCase
{
    const CATEGORIES_QUERY_REQUEST = '\Sphere\Core\Request\Categories\CategoriesQueryRequest';

    public function testMapResult()
    {
        $result = $this->mapQueryResult(static::CATEGORIES_QUERY_REQUEST);
        $this->assertInstanceOf('\Sphere\Core\Model\Category\CategoryCollection', $result);
        $this->assertCount(3, $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(static::CATEGORIES_QUERY_REQUEST);
        $this->assertInstanceOf('\Sphere\Core\Model\Category\CategoryCollection', $result);
    }
}
