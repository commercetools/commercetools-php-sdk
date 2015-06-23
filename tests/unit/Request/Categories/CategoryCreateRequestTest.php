<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Categories;


use Sphere\Core\Model\Category\CategoryDraft;
use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\RequestTestCase;

class CategoryCreateRequestTest extends RequestTestCase
{
    const CATEGORY_CREATE_REQUEST = '\Sphere\Core\Request\Categories\CategoryCreateRequest';

    protected function getDraft()
    {
        return CategoryDraft::ofNameAndSlug(
            LocalizedString::fromArray(['en' => 'category']),
            LocalizedString::fromArray(['en' => 'category'])
        );
    }
    public function testMapResult()
    {
        $result = $this->mapResult(CategoryCreateRequest::ofDraft($this->getDraft()));
        $this->assertInstanceOf('\Sphere\Core\Model\Category\Category', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(CategoryCreateRequest::ofDraft($this->getDraft()));
        $this->assertNull($result);
    }
}
