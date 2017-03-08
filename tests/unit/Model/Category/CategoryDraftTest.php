<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Category;

use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Reference;

class CategoryDraftTest extends \PHPUnit\Framework\TestCase
{
    public function testGetName()
    {
        $this->assertInstanceOf(LocalizedString::class, $this->getDraft()->getName());
    }

    public function testGetSlug()
    {
        $this->assertInstanceOf(LocalizedString::class, $this->getDraft()->getSlug());
    }

    public function testGetDescription()
    {
        $draft = $this->getDraft()->setDescription(LocalizedString::fromArray(['en'=>'description']));
        $this->assertInstanceOf(LocalizedString::class, $draft->getDescription());
    }

    public function testGetParent()
    {
        $draft = $this->getDraft()->setParent(CategoryReference::ofId('id'));
        $this->assertInstanceOf(Reference::class, $draft->getParent());
    }

    public function testGetParentType()
    {
        $draft = $this->getDraft()->setParent(CategoryReference::ofId('id'));
        $this->assertSame('category', $draft->getParent()->getTypeId());
    }

    public function testGetOrderHint()
    {
        $draft = $this->getDraft()->setOrderHint('test');
        $this->assertSame('test', $draft->getOrderHint());
    }

    public function testGetExternalId()
    {
        $draft = $this->getDraft()->setExternalId('test');
        $this->assertSame('test', $draft->getExternalId());
    }

    protected function getDraft()
    {
        return CategoryDraft::ofNameAndSlug(
            LocalizedString::fromArray(['en'=>'name']),
            LocalizedString::fromArray(['en', 'slug'])
        );
    }

    public function testFromArray()
    {
        $this->assertInstanceOf(
            CategoryDraft::class,
            CategoryDraft::fromArray(
                [
                    'name' => ['en' => 'test'],
                    'slug' => ['en' => 'test']
                ]
            )
        );
    }
}
