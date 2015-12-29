<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 10.02.15, 10:16
 */

namespace Commercetools\Core;

use Commercetools\Core\Client\JsonEndpoint;

trait AccessorTrait
{
    protected function getRequest($class, array $args = [])
    {
        $request = $this->getMockForAbstractClass(
            $class,
            array_merge([new JsonEndpoint('test')], $args)
        );

        return $request;
    }

    protected function invokePrivateMethod($class, $obj, $method, $args = null)
    {
        $reflection = new \ReflectionClass($class);

        $method = $reflection->getMethod($method);
        $method->setAccessible(true);
        return $method->invoke($obj, $args);
    }

    protected function getPrivateProperty($class, $obj, $property)
    {
        $class = new \ReflectionClass($class);
        $property = $class->getProperty($property);
        $property->setAccessible(true);

        return $property->getValue($obj);
    }
}
