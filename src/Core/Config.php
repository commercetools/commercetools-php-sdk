<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 20.01.15, 17:54
 */

namespace Commercetools\Core;

use Commercetools\Core\Client\OAuth\ClientCredentials;
use Commercetools\Core\Error\Message;
use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Helper\CorrelationIdProvider;
use Commercetools\Core\Helper\DefaultCorrelationIdProvider;
use Commercetools\Core\Helper\Uuid;
use Commercetools\Core\Model\Common\ContextAwareInterface;
use Commercetools\Core\Model\Common\ContextTrait;
use Psr\Log\LogLevel;

/**
 * Client configuration object
 *
 * @description
 *
 * Often configuration like credentials is stored in YAML or INI files. To setup the configuration object
 * this can be done by the fromArray method.
 *
 * Configuration file:
 *
 * ```
 * [commercetools]
 * client_id = '<client-id>'
 * client_secret = '<client-secret>'
 * project = '<project>'
 * ```
 *
 * Config instantiation:
 *
 * ```php
 * $iniConfig = parse_ini_file('<config-file>.ini', true);
 * $config = Config::fromArray($iniConfig['commercetools']);
 * ```
 *
 * ### Exceptions ###
 *
 * The client by default suppresses exceptions when a response had been returned by the API and the result
 * can be handled afterwards by checking the isError method of the response. For interacting with Exceptions
 * they can be enabled with the throwExceptions flag.
 *
 * ```php
 * $config->setThrowExceptions(true);
 * $client = new Client($config);
 * try {
 *     $response = $client->execute($request);
 * } catch (\Commercetools\Core\Error\ApiException $e) {
 *     // handle Exception
 * }
 * ```
 * @package Commercetools\Core
 */
class Config implements ContextAwareInterface
{
    use ContextTrait;

    const OAUTH_URL = 'oauth_url';
    const CLIENT_ID = 'client_id';
    const CLIENT_SECRET = 'client_secret';
    const SCOPE = 'scope';
    const PROJECT = 'project';
    const API_URL = 'api_url';
    const USER_NAME = 'username';
    const PASSWORD = 'password';
    const REFRESH_TOKEN = 'refresh_token';
    const BEARER_TOKEN = 'bearer_token';
    const ANONYMOUS_ID = 'anonymous_id';
    const GRANT_TYPE = 'grant_type';

    const GRANT_TYPE_CLIENT = 'client_credentials';
    const GRANT_TYPE_PASSWORD = 'password';
    const GRANT_TYPE_REFRESH = 'refresh_token';
    const GRANT_TYPE_ANONYMOUS = 'anonymous_token';
    const GRANT_TYPE_BEARER_TOKEN = 'bearer_token';

    /**
     * @var string
     */
    protected $clientSecret;

    /**
     * @var string
     */
    protected $clientId;

    /**
     * @var string
     */
    protected $project;

    /**
     * @var array
     */
    protected $scope = ['manage_project'];

    /**
     * @var string
     */
    protected $oauthUrl = 'https://auth.sphere.io';

    /**
     * @var string
     */
    protected $apiUrl = 'https://api.sphere.io';

    /**
     * @var int
     */
    protected $batchPoolSize = 25;

    protected $adapter;

    /**
     * @var bool
     */
    protected $throwExceptions = false;

    protected $acceptEncoding = 'gzip';

    protected $grantType = 'client_credentials';

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $refreshToken;

    /**
     * @var string
     */
    protected $bearerToken;

    /**
     * @var string
     */
    protected $anonymousId;

    /**
     * @var string
     */
    protected $cacheDir;

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

    protected $clientOptions = [];

    protected $oauthClientOptions = [];

    public function __construct()
    {
        $this->enableCorrelationId = Uuid::active();
    }

    /**
     * @param array $configValues
     * @return static
     */
    public static function fromArray(array $configValues)
    {
        $config = static::of();
        array_walk(
            $configValues,
            function ($value, $key) use ($config) {
                $functionName = 'set' . $config->camelize($key);
                if (!is_callable([$config, $functionName])) {
                    throw new InvalidArgumentException(sprintf(Message::SETTER_NOT_IMPLEMENTED, $key));
                }
                $config->$functionName($value);
            }
        );

        return $config;
    }

    protected function camelize($scored)
    {
        return lcfirst(
            implode(
                '',
                array_map(
                    'ucfirst',
                    array_map(
                        'strtolower',
                        explode('_', $scored)
                    )
                )
            )
        );
    }

    /**
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * @param string $clientSecret
     * @return $this
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;

        return $this;
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     * @return $this
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;

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

    /**
     * @return string
     */
    public function getScope()
    {
        $scope = $this->scope;
        $project = $this->getProject();

        $permissions = [];
        foreach ($scope as $key => $value) {
            if (is_numeric($key)) { // scope defined as string e.g. scope:project_key
                if (strpos($value, ':') === false) { // scope without project key
                    $value = $value . ':' . $project;
                }
                $permissions[] = $value;
            } else { // scope defined as array
                $permissions[] = $key . ':' . $value;
            }
        }
        $scope = implode(' ', $permissions);

        return $scope;
    }

    /**
     * @param string $scope
     * @return $this
     */
    public function setScope($scope)
    {
        if (empty($scope)) {
            $scope = [];
        }
        if (!is_array($scope)) {
            $scope = explode(' ', $scope);
        }
        $this->scope = $scope;

        return $this;
    }

    /**
     * @return string
     */
    public function getOauthUrl()
    {
        switch ($this->getGrantType()) {
            case static::GRANT_TYPE_ANONYMOUS:
                return $this->oauthUrl . '/oauth/' . $this->getProject() . '/anonymous/token';
            case static::GRANT_TYPE_PASSWORD:
            case static::GRANT_TYPE_REFRESH:
                return $this->oauthUrl . '/oauth/' . $this->getProject() . '/customers/token';
            default:
                return $this->oauthUrl . '/oauth/token';
        }
    }

    /**
     * @param string $oauthUrl
     * @return $this
     */
    public function setOauthUrl($oauthUrl)
    {
        $this->oauthUrl = $oauthUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getApiUrl()
    {
        return $this->apiUrl;
    }

    /**
     * @param string $apiUrl
     * @return $this
     */
    public function setApiUrl($apiUrl)
    {
        $this->apiUrl = $apiUrl;

        return $this;
    }

    /**
     * @return bool
     */
    public function check()
    {
        if (is_null($this->getClientId()) && $this->getGrantType() !== self::GRANT_TYPE_BEARER_TOKEN) {
            throw new InvalidArgumentException(Message::NO_CLIENT_ID);
        }

        if (is_null($this->getClientSecret()) && $this->getGrantType() !== self::GRANT_TYPE_BEARER_TOKEN) {
            throw new InvalidArgumentException(Message::NO_CLIENT_SECRET);
        }

        if (is_null($this->getProject())) {
            throw new InvalidArgumentException(Message::NO_PROJECT_ID);
        }

        return true;
    }

    /**
     * @deprecated use getClientOptions()['concurrency'] instead
     * @return int
     */
    public function getBatchPoolSize()
    {
        if (!isset($this->clientOptions['concurrency'])) {
            return $this->batchPoolSize;
        }
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
        $this->batchPoolSize = $batchPoolSize;

        return $this;
    }

    /**
     * @return string
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * @param string $adapter
     * @return $this
     */
    public function setAdapter($adapter)
    {
        $this->adapter = $adapter;

        return $this;
    }

    /**
     * @return bool
     */
    public function getThrowExceptions()
    {
        return $this->throwExceptions;
    }

    /**
     * @param bool $throwExceptions
     * @return $this
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
     * @return $this
     */
    public function setAcceptEncoding($acceptEncoding)
    {
        $this->acceptEncoding = $acceptEncoding;

        return $this;
    }

    /**
     * @return static
     */
    public static function of()
    {
        return new static();
    }

    /**
     * @return string
     */
    public function getGrantType()
    {
        return $this->grantType;
    }

    /**
     * @param string $grantType
     * @return $this
     */
    public function setGrantType($grantType)
    {
        $this->grantType = $grantType;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * @param string $refreshToken
     * @return $this
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;

        return $this;
    }

    /**
     * @return string
     */
    public function getAnonymousId()
    {
        return $this->anonymousId;
    }

    /**
     * @param string $anonymousId
     * @return $this
     */
    public function setAnonymousId($anonymousId)
    {
        $this->anonymousId = $anonymousId;

        return $this;
    }

    /**
     * @return string
     */
    public function getCacheDir()
    {
        return $this->cacheDir;
    }

    /**
     * @param string $cacheDir
     * @return $this
     */
    public function setCacheDir($cacheDir)
    {
        $this->cacheDir = $cacheDir;

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
     * @return $this
     */
    public function setLogLevel($logLevel)
    {
        $this->logLevel = $logLevel;

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
     * @return Config
     */
    public function setCorrelationIdProvider(CorrelationIdProvider $correlationIdProvider)
    {
        $this->correlationIdProvider = $correlationIdProvider;
        $this->setEnableCorrelationId(true);
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
     * @return Config
     */
    public function setEnableCorrelationId($enableCorrelationId)
    {
        $this->enableCorrelationId = (bool)$enableCorrelationId;
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
     * @return Config
     */
    public function setClientOptions(array $clientOptions)
    {
        $this->clientOptions = $clientOptions;
        return $this;
    }

    /**
     * @return array
     */
    public function getOAuthClientOptions()
    {
        return $this->oauthClientOptions;
    }

    /**
     * @param array $clientOptions
     * @return Config
     */
    public function setOAuthClientOptions(array $clientOptions)
    {
        $this->oauthClientOptions = $clientOptions;
        return $this;
    }

    /**
     * @return string
     */
    public function getBearerToken()
    {
        return $this->bearerToken;
    }

    /**
     * @param string $bearerToken
     * @return Config
     */
    public function setBearerToken($bearerToken)
    {
        $this->bearerToken = $bearerToken;
        return $this;
    }

    public function getClientCredentials()
    {
        return new ClientCredentials([
            ClientCredentials::CLIENT_ID => $this->clientId,
            ClientCredentials::CLIENT_SECRET => $this->clientSecret,
            ClientCredentials::SCOPE => $this->getScope()
        ]);
    }
}
