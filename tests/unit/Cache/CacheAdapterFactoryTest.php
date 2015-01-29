<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 21.01.15, 14:28
 */

namespace Sphere\Core\Cache;

function extension_loaded($value) {
    if ($value === 'apc') {
        return CacheAdapterFactoryTest::getApcLoaded();
    }
    return \extension_loaded($value);
}

class CacheAdapterFactoryTest extends \PHPUnit_Framework_TestCase
{
    protected static $apcLoaded;

    public static function getApcLoaded(){
        return static::$apcLoaded;
    }
    /**
     * test if apc is default cache adapter and APC module is available
     */
    public function testApcDefault()
    {
        static::$apcLoaded = true;
        $this->assertInstanceOf('\Sphere\Core\Cache\ApcCacheAdapter', $this->getFactory()->get());
    }

    /**
     * test if no cache adapter is given and APC module is not available
     * @expectedException \InvalidArgumentException
     */
    public function testNullDefault()
    {
        static::$apcLoaded = false;
        $this->getFactory()->get();
    }

    /**
     * test if default adapter returns correct interface
     */
    public function testAdapterInterface()
    {
        static::$apcLoaded = true;
        $this->assertInstanceOf('\Sphere\Core\Cache\CacheAdapterInterface', $this->getFactory()->get());
    }

    /**
     * test correct callback behaviour
     */
    public function testCallback()
    {
        $factory = $this->getFactory();
        $factory->registerCallback(function () { return new NullCacheAdapter(); });

        $this->assertInstanceOf('\Sphere\Core\Cache\NullCacheAdapter', $factory->get(new \ArrayObject()));
    }

    /**
     * test correct type handling
     *
     * @expectedException \Sphere\Core\Error\InvalidArgumentException
     */
    public function testNoObjectException()
    {
        $this->getFactory()->get([]);
    }

    /**
     * test correct type handling
     *
     * @expectedException \Sphere\Core\Error\InvalidArgumentException
     */
    public function testNoAdapterException()
    {
        $this->getFactory()->get(new \ArrayObject());
    }

    protected function getFactory()
    {
        return new CacheAdapterFactory();
    }
}
