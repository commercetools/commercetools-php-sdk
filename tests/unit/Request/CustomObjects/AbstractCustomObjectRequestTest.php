<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CustomObjects;


use Sphere\Core\AccessorTrait;

/**
 * Class AbstractCustomObjectRequestTest
 * @package Sphere\Core\Request\CustomObjects
 */
class AbstractCustomObjectRequestTest extends \PHPUnit_Framework_TestCase
{
    use AccessorTrait;

    const ABSTRACT_CUSTOM_OBJECT_REQUEST = '\Sphere\Core\Request\CustomObjects\AbstractCustomObjectRequest';

    protected function getRequest($class, array $args = [])
    {
        $request = $this->getMockForAbstractClass(
            $class,
            array_merge($args)
        );

        return $request;
    }

    public function testPath()
    {
        $request = $this->getRequest(static::ABSTRACT_CUSTOM_OBJECT_REQUEST, ['my-namespace', 'my-key']);
        $this->assertSame(
            'custom-objects/my-namespace/my-key',
            $this->invokePrivateMethod(static::ABSTRACT_CUSTOM_OBJECT_REQUEST, $request, 'getPath')
        );
    }

    public function testBuildResponse()
    {
        $guzzleResponse = $this->getMock('\GuzzleHttp\Psr7\Response', [], [], '', false);
        $request = $this->getRequest(static::ABSTRACT_CUSTOM_OBJECT_REQUEST, ['my-namespace', 'my-key']);
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf('\Sphere\Core\Response\SingleResourceResponse', $response);
    }
}
