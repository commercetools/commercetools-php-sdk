<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 21.01.15, 15:53
 */

namespace Commercetools\Core\Cache;

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
        $this->assertTrue($this->adapter->has('test'));
    }

    public function testFetch()
    {
        $this->assertSame(['key' => 'value'], $this->adapter->fetch('test'));
    }

    public function testStore()
    {
        $this->assertTrue($this->adapter->store('test1', ['key1' => 'value1']));
        $this->assertTrue($this->adapter->has('test1'));
        $this->assertSame(['key1' => 'value1'], $this->adapter->fetch('test1'));
    }

    public function testRemove()
    {
        $this->assertTrue($this->adapter->has('test'));
        $this->assertTrue($this->adapter->remove('test'));
        $this->assertFalse($this->adapter->has('test'));
    }

    public function testRemoveNonExisting()
    {
        $this->assertFalse($this->adapter->has('test2'));
        $this->assertTrue($this->adapter->remove('test2'));
    }
}
