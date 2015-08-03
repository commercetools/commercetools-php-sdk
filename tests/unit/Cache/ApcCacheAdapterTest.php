<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 21.01.15, 15:37
 */

namespace Commercetools\Core\Cache;


class ApcCacheAdapterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ApcCacheAdapter
     */
    protected $adapter;

    public function setUp()
    {
        if (!function_exists('apc_store')) {
            $this->markTestSkipped(
                'The APCU extension is not available.'
            );
        }
        $this->adapter = new ApcCacheAdapter();
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

    public function testRemove()
    {
        $this->assertTrue($this->adapter->remove('test'));
    }

    public function testRemoveFail()
    {
        $this->assertFalse($this->adapter->remove('test1'));
    }
}
