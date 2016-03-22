<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 10.02.15, 10:29
 */

namespace Commercetools\Core\Request;

use Monolog\Handler\TestHandler;
use Monolog\Logger;
use Commercetools\Core\AccessorTrait;
use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Model\Common\Context;

/**
 * Class AbstractCreateRequestTest
 * @package Commercetools\Core\Request
 * @method AbstractUpdateByKeyRequest getRequest($class, array $args = [])
 */
class AbstractUpdateByKeyRequestTest extends \PHPUnit_Framework_TestCase
{
    use AccessorTrait;

    const ABSTRACT_UPDATE_REQUEST = '\Commercetools\Core\Request\AbstractUpdateByKeyRequest';

    /**
     * @return AbstractUpdateRequest
     */
    protected function getUpdateRequest()
    {
        $request = $this->getRequest(static::ABSTRACT_UPDATE_REQUEST, ['key', 'version']);

        return $request;
    }

    public function testGetId()
    {
        $request = $this->getRequest(static::ABSTRACT_UPDATE_REQUEST, ['', '']);
        $request->setKey('key');
        $this->assertSame('key', $request->getKey());
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

        $this->assertSame(HttpMethod::POST, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = $this->getUpdateRequest();
        $httpRequest = $request->httpRequest();

        $this->assertSame('test/key=key', (string)$httpRequest->getUri());
    }

    public function testHttpRequestObject()
    {
        $request = $this->getUpdateRequest();
        $httpRequest = $request->httpRequest();

        $this->assertSame('{"version":"version","actions":[]}', (string)$httpRequest->getBody());
    }

    public function testBuildResponse()
    {
        $guzzleResponse = $this->getMock('\GuzzleHttp\Psr7\Response', [], [], '', false);
        $request = $this->getUpdateRequest();
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf('\Commercetools\Core\Response\ResourceResponse', $response);
    }

    public function testAddAction()
    {
        $request = $this->getUpdateRequest();
        $request->addActionAsArray(['key' => 'value']);
        $httpRequest = $request->httpRequest();

        $this->assertSame('{"version":"version","actions":[{"key":"value"}]}', (string)$httpRequest->getBody());
    }

    public function testLogLimit()
    {
        $handler = new TestHandler();
        $logger = new Logger('test');
        $logger->pushHandler($handler);

        $request = $this->getUpdateRequest();
        $request->setContext(Context::of()->setLogger($logger));
        for ($i = 0; $i <= (AbstractUpdateRequest::ACTION_WARNING_TRESHOLD); $i++) {
            $request->addActionAsArray(['key' => 'value']);
        }

        $logEntry = $handler->getRecords()[0];
        $this->assertSame(Logger::WARNING, $logEntry['level']);
        $this->assertSame('Update call test/key=key has over 400 update actions.', $logEntry['message']);
    }

    public function testLogLimitNoException()
    {
        $request = $this->getUpdateRequest();
        for ($i = 0; $i < (AbstractUpdateRequest::ACTION_MAX_LIMIT); $i++) {
            $request->addActionAsArray(['key' => 'value']);
        }
        $this->assertCount(AbstractUpdateRequest::ACTION_MAX_LIMIT, $request->getActions());
    }

    /**
     * @expectedException \Commercetools\Core\Error\UpdateActionLimitException
     */
    public function testLogLimitException()
    {
        $request = $this->getUpdateRequest();
        for ($i = 0; $i <= (AbstractUpdateRequest::ACTION_MAX_LIMIT); $i++) {
            $request->addActionAsArray(['key' => 'value']);
        }
    }
}
