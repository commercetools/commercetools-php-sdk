<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Client;

use Commercetools\Core\ConfigObject;
use Commercetools\Core\Helper\CorrelationIdProvider;
use Commercetools\Core\Helper\DefaultCorrelationIdProvider;
use Psr\Log\LogLevel;

class ClientConfig extends ConfigObject
{
    /**
     * @var string
     */
    protected $project;

    protected $baseUri;

    protected $adapter;

    /**
     * @var bool
     */
    protected $throwExceptions = false;

    protected $acceptEncoding = 'gzip';

    protected $clientOptions = [
        'concurrency' => 25
    ];

    /**
     * @var string
     */
    protected $logLevel = LogLevel::INFO;

    protected $messageFormatter;

    /**
     * @var bool
     */
    protected $enableCorrelationId = false;

    /**
     * @var CorrelationIdProvider
     */
    protected $correlationIdProvider;

    /**
     * ClientOptions constructor.
     * @param $baseUri
     */
    public function __construct($baseUri)
    {
        $this->baseUri = $baseUri;
    }

    /**
     * @return mixed
     */
    public function getBaseUri()
    {
        return $this->baseUri;
    }

    /**
     * @param mixed $baseUri
     * @return ClientConfig
     */
    public function setBaseUri($baseUri)
    {
        $this->baseUri = $baseUri;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * @param mixed $adapter
     * @return ClientConfig
     */
    public function setAdapter($adapter)
    {
        $this->adapter = $adapter;
        return $this;
    }

    /**
     * @return bool
     */
    public function isThrowExceptions()
    {
        return $this->throwExceptions;
    }

    /**
     * @param bool $throwExceptions
     * @return ClientConfig
     */
    public function setThrowExceptions($throwExceptions)
    {
        $this->throwExceptions = (bool)$throwExceptions;
        return $this;
    }

    /**
     * @return string
     */
    public function getAcceptEncoding()
    {
        return $this->acceptEncoding;
    }

    /**
     * @param string $acceptEncoding
     * @return ClientConfig
     */
    public function setAcceptEncoding($acceptEncoding)
    {
        $this->acceptEncoding = $acceptEncoding;
        return $this;
    }

    /**
     * @return array
     */
    public function getClientOptions()
    {
        return $this->clientOptions;
    }

    /**
     * @param array $clientOptions
     * @return ClientConfig
     */
    public function setClientOptions($clientOptions)
    {
        $this->clientOptions = $clientOptions;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogLevel()
    {
        return $this->logLevel;
    }

    /**
     * @param string $logLevel
     * @return ClientConfig
     */
    public function setLogLevel($logLevel)
    {
        $this->logLevel = $logLevel;
        return $this;
    }

    /**
     * @deprecated use getClientOptions()['concurrency'] instead
     * @return int
     */
    public function getBatchPoolSize()
    {
        return $this->clientOptions['concurrency'];
    }

    /**
     * @deprecated use setClientOptions(['concurrency' => 5]) instead
     * @param int $batchPoolSize
     * @return $this
     */
    public function setBatchPoolSize($batchPoolSize)
    {
        $this->clientOptions['concurrency'] = $batchPoolSize;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessageFormatter()
    {
        return $this->messageFormatter;
    }

    /**
     * @param mixed $messageFormatter
     * @return $this
     */
    public function setMessageFormatter($messageFormatter)
    {
        $this->messageFormatter = $messageFormatter;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEnableCorrelationId()
    {
        return $this->enableCorrelationId;
    }

    /**
     * @param bool $enableCorrelationId
     * @return $this
     */
    public function setEnableCorrelationId($enableCorrelationId)
    {
        $this->enableCorrelationId = (bool)$enableCorrelationId;
        return $this;
    }

    /**
     * @return CorrelationIdProvider|null
     */
    public function getCorrelationIdProvider()
    {
        if (!$this->isEnableCorrelationId()) {
            return null;
        }
        if (is_null($this->correlationIdProvider)) {
            $this->correlationIdProvider = DefaultCorrelationIdProvider::of($this->getProject());
        }
        return $this->correlationIdProvider;
    }

    /**
     * @param CorrelationIdProvider $correlationIdProvider
     * @return $this
     */
    public function setCorrelationIdProvider(CorrelationIdProvider $correlationIdProvider)
    {
        $this->correlationIdProvider = $correlationIdProvider;
        $this->setEnableCorrelationId(true);
        return $this;
    }

    /**
     * @return string
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @param string $project
     * @return $this
     */
    public function setProject($project)
    {
        $this->project = $project;

        return $this;
    }
}
