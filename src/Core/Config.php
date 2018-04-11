<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 20.01.15, 17:54
 */

namespace Commercetools\Core;

use Commercetools\Core\Client\ClientConfig;
use Commercetools\Core\Client\Credentials;
use Commercetools\Core\Error\Message;
use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Helper\CorrelationIdProvider;
use Commercetools\Core\Helper\DefaultCorrelationIdProvider;
use Commercetools\Core\Helper\Uuid;
use Commercetools\Core\Model\Common\ContextAwareInterface;
use Commercetools\Core\Model\Common\ContextTrait;

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
class Config extends ConfigObject implements ContextAwareInterface
{
    use ContextTrait;

    const OAUTH_URL = 'oauth_url';
    const CLIENT_ID = 'client_id';
    const CLIENT_SECRET = 'client_secret';
    const SCOPE = 'scope';
    const PROJECT = 'project';
    const API_URL = 'api_url';
    const USER_NAME = Credentials::USER_NAME;
    const PASSWORD = Credentials::PASSWORD;
    const REFRESH_TOKEN = Credentials::REFRESH_TOKEN;
    const BEARER_TOKEN = Credentials::BEARER_TOKEN;
    const ANONYMOUS_ID = Credentials::ANONYMOUS_ID;
    const GRANT_TYPE = Credentials::GRANT_TYPE;

    const GRANT_TYPE_CLIENT = Credentials::GRANT_TYPE_CLIENT;
    const GRANT_TYPE_PASSWORD = Credentials::GRANT_TYPE_PASSWORD;
    const GRANT_TYPE_REFRESH = Credentials::GRANT_TYPE_REFRESH;
    const GRANT_TYPE_ANONYMOUS = Credentials::GRANT_TYPE_ANONYMOUS;
    const GRANT_TYPE_BEARER_TOKEN = Credentials::GRANT_TYPE_BEARER_TOKEN;

    /**
     * @var Credentials
     */
    protected $credentials;

    /**
     * @var string
     */
    protected $cacheDir;

    protected $clientConfig;

    protected $oauthClientConfig;

    public function __construct()
    {
        $this->credentials = new Credentials();
        $this->clientConfig = new ClientConfig('https://api.sphere.io');
        $this->oauthClientConfig = new ClientConfig('https://auth.sphere.io');
    }

    /**
     * @return string
     */
    public function getClientSecret()
    {
        return $this->credentials->getClientSecret();
    }

    /**
     * @param string $clientSecret
     * @return $this
     */
    public function setClientSecret($clientSecret)
    {
        $this->credentials->setClientSecret($clientSecret);

        return $this;
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->credentials->getClientId();
    }

    /**
     * @param string $clientId
     * @return $this
     */
    public function setClientId($clientId)
    {
        $this->credentials->setClientId($clientId);

        return $this;
    }

    /**
     * @return string
     */
    public function getProject()
    {
        return $this->credentials->getProject();
    }

    /**
     * @param string $project
     * @return $this
     */
    public function setProject($project)
    {
        $this->credentials->setProject($project);
        $this->clientConfig->setProject($project);

        return $this;
    }

    /**
     * @return string
     */
    public function getScope()
    {
        return $this->credentials->getScope();
    }

    /**
     * @param string $scope
     * @return $this
     */
    public function setScope($scope)
    {
        $this->credentials->setScope($scope);

        return $this;
    }

    /**
     * @deprecated
     * @return string
     */
    public function getOauthUrl()
    {
        switch ($this->credentials->getGrantType()) {
            case static::GRANT_TYPE_ANONYMOUS:
                return $this->oauthClientConfig->getBaseUri() . '/oauth/' .
                    $this->credentials->getProject() . '/anonymous/token';
            case static::GRANT_TYPE_PASSWORD:
            case static::GRANT_TYPE_REFRESH:
                return $this->oauthClientConfig->getBaseUri() . '/oauth/' .
                    $this->credentials->getProject() . '/customers/token';
            default:
                return $this->oauthClientConfig->getBaseUri() . '/oauth/token';
        }
    }

    /**
     * @param string $oauthUrl
     * @return $this
     */
    public function setOauthUrl($oauthUrl)
    {
        $this->oauthClientConfig->setBaseUri($oauthUrl);

        return $this;
    }

    /**
     * @return string
     */
    public function getApiUrl()
    {
        return $this->clientConfig->getBaseUri();
    }

    /**
     * @param string $apiUrl
     * @return $this
     */
    public function setApiUrl($apiUrl)
    {
        $this->clientConfig->setBaseUri($apiUrl);

        return $this;
    }

    /**
     * @return bool
     */
    public function check()
    {
        return $this->credentials->check();
    }

    /**
     * @deprecated use getClientOptions()['concurrency'] instead
     * @return int
     */
    public function getBatchPoolSize()
    {
        return $this->clientConfig->getBatchPoolSize();
    }

    /**
     * @deprecated use setClientOptions(['concurrency' => 5]) instead
     * @param int $batchPoolSize
     * @return $this
     */
    public function setBatchPoolSize($batchPoolSize)
    {
        $this->clientConfig->setBatchPoolSize($batchPoolSize);

        return $this;
    }

    /**
     * @return string
     */
    public function getAdapter()
    {
        return $this->clientConfig->getAdapter();
    }

    /**
     * @param string $adapter
     * @return $this
     */
    public function setAdapter($adapter)
    {
        $this->clientConfig->setAdapter($adapter);

        return $this;
    }

    /**
     * @return bool
     */
    public function getThrowExceptions()
    {
        return $this->clientConfig->isThrowExceptions();
    }

    /**
     * @param bool $throwExceptions
     * @return $this
     */
    public function setThrowExceptions($throwExceptions)
    {
        $this->clientConfig->setThrowExceptions($throwExceptions);

        return $this;
    }

    /**
     * @return string
     */
    public function getAcceptEncoding()
    {
        return $this->clientConfig->getAcceptEncoding();
    }

    /**
     * @param string $acceptEncoding
     * @return $this
     */
    public function setAcceptEncoding($acceptEncoding)
    {
        $this->clientConfig->setAcceptEncoding($acceptEncoding);

        return $this;
    }

    /**
     * @return string
     */
    public function getGrantType()
    {
        return $this->credentials->getGrantType();
    }

    /**
     * @param string $grantType
     * @return $this
     */
    public function setGrantType($grantType)
    {
        $this->credentials->setGrantType($grantType);

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->credentials->getUsername();
    }

    /**
     * @param string $username
     * @return $this
     */
    public function setUsername($username)
    {
        $this->credentials->setUsername($username);

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->credentials->getPassword();
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->credentials->setPassword($password);

        return $this;
    }

    /**
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->credentials->getRefreshToken();
    }

    /**
     * @param string $refreshToken
     * @return $this
     */
    public function setRefreshToken($refreshToken)
    {
        $this->credentials->setRefreshToken($refreshToken);

        return $this;
    }

    /**
     * @return string
     */
    public function getAnonymousId()
    {
        return $this->credentials->getAnonymousId();
    }

    /**
     * @param string $anonymousId
     * @return $this
     */
    public function setAnonymousId($anonymousId)
    {
        $this->credentials->setAnonymousId($anonymousId);

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
        return $this->clientConfig->getLogLevel();
    }

    /**
     * @param string $logLevel
     * @return $this
     */
    public function setLogLevel($logLevel)
    {
        $this->clientConfig->setLogLevel($logLevel);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessageFormatter()
    {
        return $this->clientConfig->getMessageFormatter();
    }

    /**
     * @param mixed $messageFormatter
     * @return $this
     */
    public function setMessageFormatter($messageFormatter)
    {
        $this->clientConfig->setMessageFormatter($messageFormatter);
        return $this;
    }

    /**
     * @return CorrelationIdProvider|null
     */
    public function getCorrelationIdProvider()
    {
        return $this->clientConfig->getCorrelationIdProvider();
    }

    /**
     * @param CorrelationIdProvider $correlationIdProvider
     * @return Config
     */
    public function setCorrelationIdProvider(CorrelationIdProvider $correlationIdProvider)
    {
        $this->clientConfig->setCorrelationIdProvider($correlationIdProvider);

        return $this;
    }

    /**
     * @return bool
     */
    public function isEnableCorrelationId()
    {
        return $this->clientConfig->isEnableCorrelationId();
    }

    /**
     * @param bool $enableCorrelationId
     * @return Config
     */
    public function setEnableCorrelationId($enableCorrelationId)
    {
        $this->clientConfig->setEnableCorrelationId($enableCorrelationId);
        return $this;
    }

    /**
     * @return array
     */
    public function getClientOptions()
    {
        return $this->clientConfig->getClientOptions();
    }

    /**
     * @param array $clientConfig
     * @return Config
     */
    public function setClientOptions(array $clientConfig)
    {
        $this->clientConfig->setClientOptions($clientConfig);
        return $this;
    }

    /**
     * @return array
     */
    public function getOAuthClientOptions()
    {
        return $this->oauthClientConfig->getClientOptions();
    }

    /**
     * @param array $clientOptions
     * @return Config
     */
    public function setOAuthClientOptions(array $clientOptions)
    {
        $this->oauthClientConfig->setClientOptions($clientOptions);
        return $this;
    }

    /**
     * @return string
     */
    public function getBearerToken()
    {
        return $this->credentials->getBearerToken();
    }

    /**
     * @param string $bearerToken
     * @return Config
     */
    public function setBearerToken($bearerToken)
    {
        $this->credentials->setBearerToken($bearerToken);
        return $this;
    }

    /**
     * @return Credentials
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * @param Credentials $credentials
     * @return Config
     */
    public function setCredentials(Credentials $credentials)
    {
        $this->credentials = $credentials;
        return $this;
    }

    /**
     * @return ClientConfig
     */
    public function getClientConfig()
    {
        return $this->clientConfig;
    }

    /**
     * @param ClientConfig $clientConfig
     * @return Config
     */
    public function setClientConfig(ClientConfig $clientConfig)
    {
        $this->clientConfig = $clientConfig;
        return $this;
    }

    /**
     * @return ClientConfig
     */
    public function getOauthClientConfig()
    {
        return $this->oauthClientConfig;
    }

    /**
     * @param ClientConfig $oauthClientConfig
     * @return Config
     */
    public function setOauthClientConfig(ClientConfig $oauthClientConfig)
    {
        $this->oauthClientConfig = $oauthClientConfig;
        return $this;
    }
}
