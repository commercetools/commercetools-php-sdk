<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 10.02.15, 10:29
 */

namespace Sphere\Core\Request;


use GuzzleHttp\Message\Response;
use Monolog\Handler\TestHandler;
use Monolog\Logger;
use Sphere\Core\AccessorTrait;
use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Model\Common\Context;

/**
 * Class AbstractCreateRequestTest
 * @package Sphere\Core\Request
 * @method AbstractUpdateRequest getRequest($class, array $args = [])
 */
class AbstractUpdateRequestTest extends \PHPUnit_Framework_TestCase
{
    use AccessorTrait;

    const ABSTRACT_UPDATE_REQUEST = '\Sphere\Core\Request\AbstractUpdateRequest';

    /**
     * @return AbstractUpdateRequest
     */
    protected function getUpdateRequest()
    {
        $request = $this->getRequest(static::ABSTRACT_UPDATE_REQUEST, ['id', 'version']);

        return $request;
    }

    public function testGetId()
    {
        $request = $this->getRequest(static::ABSTRACT_UPDATE_REQUEST, ['', '']);
        $request->setId('id');
        $this->assertSame('id', $request->getId());
    }

    public function testGetVersion()
    {
        $request = $this->getRequest(static::ABSTRACT_UPDATE_REQUEST, ['', '']);
        $request->setVersion('version');
        $this->assertSame('version', $request->getVersion());
    }


    public function testHttpRequestMethod()
    {
        $request = $this->getUpdateRequest();
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::POST, $httpRequest->getHttpMethod());
    }

    public function testHttpRequestPath()
    {
        $request = $this->getUpdateRequest();
        $httpRequest = $request->httpRequest();

        $this->assertSame('test/id', $httpRequest->getPath());
    }

    public function testHttpRequestObject()
    {
        $request = $this->getUpdateRequest();
        $httpRequest = $request->httpRequest();

        $this->assertSame('{"version":"version","actions":[]}', $httpRequest->getBody());
    }

    public function testBuildResponse()
    {
        $guzzleResponse = $this->getMock('\GuzzleHttp\Message\Response', [], [], '', false);
        $request = $this->getUpdateRequest();
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf('\Sphere\Core\Response\SingleResourceResponse', $response);
    }

    public function testAddAction()
    {
        $request = $this->getUpdateRequest();
        $request->addAction(['key' => 'value']);
        $httpRequest = $request->httpRequest();

        $this->assertSame('{"version":"version","actions":[{"key":"value"}]}', $httpRequest->getBody());
    }

    public function testLogLimit()
    {
        $handler = new TestHandler();
        $logger = new Logger('test');
        $logger->pushHandler($handler);

        $request = $this->getUpdateRequest();
        $request->setContext(Context::of()->setLogger($logger));
        for ($i = 0; $i <= 51; $i++) {
            $request->addAction(['key' => 'value']);
        }

        $logEntry = $handler->getRecords()[1];
        $this->assertSame(Logger::WARNING, $logEntry['level']);
        $this->assertSame('Update call test/id over limit of 50 update actions', $logEntry['message']);
    }
}
