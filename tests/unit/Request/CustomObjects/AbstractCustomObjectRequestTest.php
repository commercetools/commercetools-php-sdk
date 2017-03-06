<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CustomObjects;

use Commercetools\Core\AccessorTrait;
use Commercetools\Core\Response\ResourceResponse;

/**
 * Class AbstractCustomObjectRequestTest
 * @package Commercetools\Core\Request\CustomObjects
 */
class AbstractCustomObjectRequestTest extends \PHPUnit\Framework\TestCase
{
    use AccessorTrait;

    const ABSTRACT_CUSTOM_OBJECT_REQUEST = AbstractCustomObjectRequest::class;

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
        $mockBuilder = $this->getMockBuilder('\GuzzleHttp\Psr7\Response');
        $mockBuilder->disableOriginalConstructor();
        $guzzleResponse = $mockBuilder->getMock();

        $request = $this->getRequest(static::ABSTRACT_CUSTOM_OBJECT_REQUEST, ['my-namespace', 'my-key']);
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf(ResourceResponse::class, $response);
    }
}
