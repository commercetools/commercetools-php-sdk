<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 21.01.15, 15:58
 */

namespace SphereIO\Cache;


class AbstractCacheAdapterTest extends \PHPUnit_Framework_TestCase
{
    protected $adapter;

    public function testGetCache()
    {
        /**
         * @var AbstractCacheAdapter $adapter
         */
        $adapter = $this->getMockBuilder('\SphereIO\Cache\AbstractCacheAdapter')
            ->setConstructorArgs([['key' => 'value']])
            ->getMockForAbstractClass();
        $this->assertEquals(['key' => 'value'], $adapter->getCache());
    }
}
