<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product\Search;

class FilterSubtreeTest extends \PHPUnit\Framework\TestCase
{
    public function testMapValue()
    {
        $subtree = FilterSubtree::ofId('12345');
        $this->assertSame('subtree("12345")', (string)$subtree);
    }

    public function testDefaultType()
    {
        $subtrees = FilterSubtreeCollection::of();
        $subtrees
            ->add(FilterSubtree::ofId('12345'))
            ->add(FilterSubtree::ofId('abcde'))
        ;
        $this->assertSame('subtree("12345"),subtree("abcde")', (string)$subtrees);
    }

    public function testCollectionIds()
    {
        $subtrees = FilterSubtreeCollection::ofIds(['12345', 'abcde']);
        $this->assertSame('subtree("12345"),subtree("abcde")', (string)$subtrees);
    }

    public function testIntValue()
    {
        $subtree = FilterSubtree::ofId(12345);
        $this->assertSame('subtree("12345")', (string)$subtree);
    }
}
