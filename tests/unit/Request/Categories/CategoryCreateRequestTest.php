<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Categories;

use Commercetools\Core\Model\Category\CategoryDraft;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\RequestTestCase;

class CategoryCreateRequestTest extends RequestTestCase
{
    const CATEGORY_CREATE_REQUEST = '\Commercetools\Core\Request\Categories\CategoryCreateRequest';

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
        $this->assertInstanceOf('\Commercetools\Core\Model\Category\Category', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(CategoryCreateRequest::ofDraft($this->getDraft()));
        $this->assertNull($result);
    }
}
