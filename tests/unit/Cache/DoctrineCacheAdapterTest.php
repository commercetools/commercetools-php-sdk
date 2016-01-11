<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 22.01.15, 10:46
 */

namespace Commercetools\Core\Cache;

use Doctrine\Common\Cache\ApcCache;
use Doctrine\Common\Cache\ApcuCache;

class DoctrineCacheAdapterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DoctrineCacheAdapter
     */
    protected $adapter;

    public function setUp()
    {
        if (!extension_loaded('apc') && !extension_loaded('apcu')) {
            $this->markTestSkipped(
                'The APCu extension is not loaded.'
            );
        }
        if (class_exists('\Doctrine\Common\Cache\ApcuCache')) {
            $cache = new ApcuCache();
        } else {
            $cache = new ApcCache();
        }
        $this->adapter = new DoctrineCacheAdapter($cache);
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
        $this->assertTrue($this->adapter->remove('test1'));
    }
}
