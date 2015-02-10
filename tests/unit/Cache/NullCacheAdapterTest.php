<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 21.01.15, 15:53
 */

namespace Sphere\Core\Cache;


class NullCacheAdapterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var NullCacheAdapter
     */
    protected $adapter;

    public function setUp()
    {
        $this->adapter = new NullCacheAdapter();
        $this->adapter->store('test', ['key' => 'value']);
    }

    public function testHas()
    {
        $this->assertFalse($this->adapter->has('test'));
    }

    public function testFetch()
    {
        $this->assertFalse($this->adapter->fetch('test'));
    }

    public function testStore()
    {
        $this->assertTrue($this->adapter->store('test1', ['key1' => 'value1']));
    }

    public function testRemove()
    {
        $this->assertTrue($this->adapter->remove('test2'));
    }
}
