<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 10.02.15, 09:57
 */

namespace Sphere\Core\Request;


use Sphere\Core\AccessorTrait;
use Sphere\Core\Error\InvalidArgumentException;

/**
 * Class AbstractApiRequestTest
 * @package Sphere\Core\Request
 * @method AbstractCreateRequest getRequest($class)
 */
class AbstractApiRequestTest extends \PHPUnit_Framework_TestCase
{
    use AccessorTrait;

    const ABSTRACT_API_REQUEST = '\Sphere\Core\Request\AbstractApiRequest';

    public function testEndpoint()
    {
        $request = $this->getRequest(static::ABSTRACT_API_REQUEST);
        $this->assertInstanceOf('\Sphere\Core\Client\JsonEndpoint', $request->getEndpoint());
        $this->assertSame('test', $request->getEndpoint()->endpoint());
    }

    public function testEndpointPath()
    {
        $request = $this->getRequest(static::ABSTRACT_API_REQUEST);
        $this->assertSame('test', $request->getEndpoint()->endpoint());
    }

    public function testAddParam()
    {
        $request = $this->getRequest(static::ABSTRACT_API_REQUEST);
        $request->addParam('key', 'value');
        $this->assertSame(
            ['key=value' => ['key' => 'value']],
            $this->getPrivateProperty(static::ABSTRACT_API_REQUEST, $request, 'params')
        );
    }

    public function testNullValue()
    {
        $request = $this->getRequest(static::ABSTRACT_API_REQUEST);
        $request->addParam('key', null);
        $this->assertSame(
            '?key',
            $this->invokePrivateMethod(static::ABSTRACT_API_REQUEST, $request, 'getParamString')
        );
    }

    public function testTrueParam()
    {
        $request = $this->getRequest(static::ABSTRACT_API_REQUEST);
        $request->addParam('key', true);
        $this->assertSame(
            '?key=true',
            $this->invokePrivateMethod(static::ABSTRACT_API_REQUEST, $request, 'getParamString')
        );
    }

    public function testFalseParam()
    {
        $request = $this->getRequest(static::ABSTRACT_API_REQUEST);
        $request->addParam('key', false);
        $this->assertSame(
            '?key=false',
            $this->invokePrivateMethod(static::ABSTRACT_API_REQUEST, $request, 'getParamString')
        );
    }

    public function testParamString()
    {
        $request = $this->getRequest(static::ABSTRACT_API_REQUEST);
        $request->addParam('key', 'value1');
        $request->addParam('key', 'value2');
        $this->assertSame(
            '?key=value1&key=value2',
            $this->invokePrivateMethod(static::ABSTRACT_API_REQUEST, $request, 'getParamString')
        );
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testNoParamKey()
    {
        $request = $this->getRequest(static::ABSTRACT_API_REQUEST);
        $request->addParam('', '');
    }

    public function testPath()
    {
        $request = $this->getRequest(static::ABSTRACT_API_REQUEST);
        $request->addParam('key', 'value1');
        $request->addParam('key', 'value2');
        $request->addParam('abc', 'xyz');
        $this->assertSame(
            'test?abc=xyz&key=value1&key=value2',
            $this->invokePrivateMethod(static::ABSTRACT_API_REQUEST, $request, 'getPath')
        );
    }

    public function testParamOrder()
    {
        $request = $this->getRequest(static::ABSTRACT_API_REQUEST);
        $request->addParam('key', 'value');
        $request->addParam('abc', 'xyz');
        $this->assertSame(
            '?abc=xyz&key=value',
            $this->invokePrivateMethod(static::ABSTRACT_API_REQUEST, $request, 'getParamString')
        );
        $this->assertSame(
            [
                'key=value' => ['key' => 'value'],
                'abc=xyz' => ['abc' => 'xyz']
            ],
            $this->getPrivateProperty(static::ABSTRACT_API_REQUEST, $request, 'params')
        );
    }
}
