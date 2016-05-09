<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Cache;

use Cache\Adapter\PHPArray\ArrayCachePool;

class PsrCacheAdapterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PsrCacheAdapter
     */
    protected $adapter;

    public function setUp()
    {
        if (version_compare(phpversion(), '5.5.0', '<')) {
            $this->markTestSkipped(
                'PHP >= 5.5 needed to run this test'
            );
        }
        $arrayCache = new ArrayCachePool();

        $this->adapter = new PsrCacheAdapter($arrayCache);
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
        $this->assertTrue($this->adapter->remove('test1'));
    }
}
