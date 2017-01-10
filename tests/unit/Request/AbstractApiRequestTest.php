<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 10.02.15, 09:57
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\AccessorTrait;
use Commercetools\Core\Client\JsonEndpoint;
use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Model\Common\JsonObject;

/**
 * Class AbstractApiRequestTest
 * @package Commercetools\Core\Request
 * @method AbstractCreateRequest getRequest($class)
 */
class AbstractApiRequestTest extends \PHPUnit_Framework_TestCase
{
    use AccessorTrait;

    const ABSTRACT_API_REQUEST = AbstractApiRequest::class;

    public function testEndpoint()
    {
        $request = $this->getRequest(static::ABSTRACT_API_REQUEST);
        $this->assertInstanceOf(JsonEndpoint::class, $request->getEndpoint());
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
            '?key=value',
            $this->invokePrivateMethod(static::ABSTRACT_API_REQUEST, $request, 'getParamString')
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

    public function testParamReplace()
    {
        $request = $this->getRequest(static::ABSTRACT_API_REQUEST);
        $request->addParam('key', 'value1');
        $request->addParam('key', 'value2');
        $this->assertSame(
            '?key=value2',
            $this->invokePrivateMethod(static::ABSTRACT_API_REQUEST, $request, 'getParamString')
        );
    }

    public function testParamString()
    {
        $request = $this->getRequest(static::ABSTRACT_API_REQUEST);
        $request->addParam('key', 'value1', false);
        $request->addParam('key', 'value2', false);
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
        $request->addParam('key', 'value1', false);
        $request->addParam('key', 'value2', false);
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
    }

    public function testGetIdentifier()
    {
        $request = $this->getRequest(static::ABSTRACT_API_REQUEST);
        $request->setIdentifier('test');
        $this->assertSame('test', $request->getIdentifier());
    }

    public function testNotEmptyIdentifier()
    {
        $request = $this->getRequest(static::ABSTRACT_API_REQUEST);
        $this->assertNotEmpty($request->getIdentifier());
    }

    public function testGetUniqueIdentifier()
    {
        $request1 = $this->getRequest(static::ABSTRACT_API_REQUEST);
        $request2 = $this->getRequest(static::ABSTRACT_API_REQUEST);
        $this->assertNotSame($request1->getIdentifier(), $request2->getIdentifier());
    }

    public function testMapResult()
    {
        $request = $this->getRequest(static::ABSTRACT_API_REQUEST);
        $result = $request->mapResult(['key' => 'value']);
        $this->assertInstanceOf(JsonObject::class, $result);
    }

    public function testMapEmptyResult()
    {
        $request = $this->getRequest(static::ABSTRACT_API_REQUEST);
        $result = $request->mapResult([]);
        $this->assertNull($result);
    }
}
