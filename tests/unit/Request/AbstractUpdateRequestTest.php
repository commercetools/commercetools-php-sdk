<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 10.02.15, 10:29
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\Error\UpdateActionLimitException;
use GuzzleHttp\Message\Response;
use Monolog\Handler\TestHandler;
use Monolog\Logger;
use Commercetools\Core\AccessorTrait;
use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Model\Common\Context;

/**
 * Class AbstractCreateRequestTest
 * @package Commercetools\Core\Request
 * @method AbstractUpdateRequest getRequest($class, array $args = [])
 */
class AbstractUpdateRequestTest extends \PHPUnit_Framework_TestCase
{
    use AccessorTrait;

    const ABSTRACT_UPDATE_REQUEST = '\Commercetools\Core\Request\AbstractUpdateRequest';

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

        $this->assertSame(HttpMethod::POST, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = $this->getUpdateRequest();
        $httpRequest = $request->httpRequest();

        $this->assertSame('test/id', (string)$httpRequest->getUri());
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
        for ($i = 0; $i < (AbstractUpdateRequest::ACTION_WARNING_TRESHOLD); $i++) {
            $request->addActionAsArray(['key' => 'value']);
        }
        $this->assertEmpty($handler->getRecords());

        $request->addActionAsArray(['key' => 'value']);
        $request->addActionAsArray(['key' => 'value']);

        $this->assertCount(1, $handler->getRecords());

        $logEntry = $handler->getRecords()[0];
        $this->assertSame(Logger::WARNING, $logEntry['level']);
        $this->assertSame('Update call test/id has over 400 update actions.', $logEntry['message']);
    }

    public function testLogLimitNoException()
    {
        $request = $this->getUpdateRequest();
        for ($i = 0; $i < (AbstractUpdateRequest::ACTION_MAX_LIMIT); $i++) {
            $request->addActionAsArray(['key' => 'value']);
        }
        $this->assertCount(AbstractUpdateRequest::ACTION_MAX_LIMIT, $request->getActions());
    }

    public function testLogLimitException()
    {
        $request = $this->getUpdateRequest();
        for ($i = 0; $i < (AbstractUpdateRequest::ACTION_MAX_LIMIT); $i++) {
            $request->addActionAsArray(['key' => 'value']);
        }

        $exceptionThrown = false;
        try {
            $request->addActionAsArray(['key' => 'value']);
        } catch (\Exception $e) {
            $exceptionThrown = true;
            $this->assertInstanceOf('\Commercetools\Core\Error\UpdateActionLimitException', $e);
        }
        $this->assertTrue($exceptionThrown);
    }
}
