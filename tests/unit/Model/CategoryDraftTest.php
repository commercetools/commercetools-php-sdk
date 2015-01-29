<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 29.01.15, 12:01
 */

namespace Sphere\Core\Model;


use Sphere\Core\Model\Draft\CategoryDraft;
use Sphere\Core\Model\Type\CategoryReference;
use Sphere\Core\Model\Type\LocalizedString;

class CategoryDraftTest extends \PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $this->assertInstanceOf('\Sphere\Core\Model\Type\LocalizedString', $this->getDraft()->getName());
    }

    public function testGetSlug()
    {
        $this->assertInstanceOf('\Sphere\Core\Model\Type\LocalizedString', $this->getDraft()->getSlug());
    }

    public function testGetDescription()
    {
        $draft = $this->getDraft()->setDescription(LocalizedString::of(['en'=>'description']));
        $this->assertInstanceOf('\Sphere\Core\Model\Type\LocalizedString', $draft->getDescription());
    }

    public function testGetParent()
    {
        $draft = $this->getDraft()->setParent(CategoryReference::of('id'));
        $this->assertInstanceOf('\Sphere\Core\Model\Type\Reference', $draft->getParent());
    }

    public function testGetParentType()
    {
        $draft = $this->getDraft()->setParent(CategoryReference::of('id'));
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
        return CategoryDraft::of(LocalizedString::of(['en'=>'name']), LocalizedString::of(['en','slug']));
    }
}
