<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Category;


use Commercetools\Core\Model\Common\LocalizedString;

class CategoryDraftTest extends \PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $this->assertInstanceOf('\Commercetools\Core\Model\Common\LocalizedString', $this->getDraft()->getName());
    }

    public function testGetSlug()
    {
        $this->assertInstanceOf('\Commercetools\Core\Model\Common\LocalizedString', $this->getDraft()->getSlug());
    }

    public function testGetDescription()
    {
        $draft = $this->getDraft()->setDescription(LocalizedString::fromArray(['en'=>'description']));
        $this->assertInstanceOf('\Commercetools\Core\Model\Common\LocalizedString', $draft->getDescription());
    }

    public function testGetParent()
    {
        $draft = $this->getDraft()->setParent(CategoryReference::ofId('id'));
        $this->assertInstanceOf('\Commercetools\Core\Model\Common\Reference', $draft->getParent());
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
            LocalizedString::fromArray(['en','slug'])
        );
    }

    public function testFromArray()
    {
        $this->assertInstanceOf(
            '\Commercetools\Core\Model\Category\CategoryDraft',
            CategoryDraft::fromArray(
                [
                    'name' => ['en' => 'test'],
                    'slug' => ['en' => 'test']
                ]
            )
        );
    }
}
