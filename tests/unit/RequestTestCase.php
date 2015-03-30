<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core;


use Sphere\Core\Request\AbstractApiRequest;

/**
 * Class RequestTestCase
 * @package Sphere\Core
 */
abstract class RequestTestCase extends \PHPUnit_Framework_TestCase
{
    protected $requestClass;
    protected $args = [];

    /**
     * @param $className
     * @param array $args
     * @return AbstractApiRequest
     */
    protected function getRequest($className, array $args = [])
    {
        $reflection = new \ReflectionClass($className);
        $request = $reflection->newInstanceArgs($args);

        return $request;
    }

    public function mapResult($requestClass, $args = [], array $result = [])
    {
        if (empty($result)) {
            $result = ['key' => 'value'];
        }
        $request = $this->getRequest($requestClass, $args);
        return $request->mapResult($result);
    }

    public function mapQueryResult($requestClass, $args = [], array $result = [])
    {
        if (empty($result)) {
            $result = [
                'results' => [
                    ['key' => 'value'],
                    ['key' => 'value'],
                    ['key' => 'value'],
                ]
            ];
        }
        $request = $this->getRequest($requestClass, $args);
        return $request->mapResult($result);
    }

    public function mapEmptyResult($requestClass, $args = [])
    {
        $request = $this->getRequest($requestClass, $args);
        return $request->mapResult([]);
    }
}
