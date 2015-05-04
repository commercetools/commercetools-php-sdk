<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 22.01.15, 10:46
 */

namespace Sphere\Core\Cache;


class PhpRedisCacheAdapterTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var DoctrineCacheAdapter
     */
    protected $adapter;

    public function setUp()
    {
        if (!extension_loaded('redis')) {
            $this->markTestSkipped(
                'The Redis extension is not available.'
            );
        }
        $cache = new \Redis();
        $cache->connect('localhost');
        $this->adapter = new PhpRedisCacheAdapter($cache);
        $this->adapter->store('test', ['key' => 'value']);
    }

    public function testHas()
    {
        $this->assertTrue($this->adapter->has('test'));
    }

    public function testHasNot()
    {
        $this->assertFalse($this->adapter->has('test1'));
    }

    public function testFetch()
    {
        $this->assertArrayHasKey('key', $this->adapter->fetch('test'));
    }

    public function testFetchFail()
    {
        $this->assertFalse($this->adapter->fetch('test1'));
    }

    public function testStore()
    {
        $this->assertTrue($this->adapter->store('test2', ['key2' => 'value2']));
    }

    public function testStoreWithLifetime()
    {
        $this->assertTrue($this->adapter->store('test2', ['key2' => 'value2'], 1));
    }

    public function testRemove()
    {
        $this->assertTrue($this->adapter->remove('test'));
    }

    public function testRemoveFail()
    {
        $this->assertFalse($this->adapter->remove('test1'));
    }
}
