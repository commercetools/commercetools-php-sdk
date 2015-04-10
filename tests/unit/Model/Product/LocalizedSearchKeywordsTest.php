<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Product;


use Sphere\Core\Error\InvalidArgumentException;
use Sphere\Core\Model\Common\Context;

class LocalizedSearchKeywordsTest extends \PHPUnit_Framework_TestCase
{
    public function testMagicGet()
    {
        $collection = new LocalizedSearchKeywords();
        $collection->setAt('en', new SearchKeywords());

        $this->assertInstanceOf('\Sphere\Core\Model\Product\SearchKeywords', $collection->en);
    }

    public function testMagicGetNotSet()
    {
        $context = new Context();
        $context->setGraceful(true);
        $collection = new LocalizedSearchKeywords([], $context);
        $this->assertSame('', $collection->en);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGetNoLocale()
    {
        $collection = new LocalizedSearchKeywords();
        $collection->get();
    }

    public function testAdd()
    {
        $collection = new LocalizedSearchKeywords();
        $collection->add(new SearchKeywords());

        $this->assertInstanceOf('\Sphere\Core\Model\Product\SearchKeywords', $collection->getAt(0));
    }
}
