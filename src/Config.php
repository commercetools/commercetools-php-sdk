<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 20.01.15, 17:54
 */

namespace Commercetools\Core;

use Commercetools\Core\Error\Message;
use Commercetools\Core\Error\InvalidArgumentException;
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
class Config implements ContextAwareInterface
{
    use ContextTrait;

    const OAUTH_URL = 'oauth_url';
    const CLIENT_ID = 'client_id';
    const CLIENT_SECRET = 'client_secret';
    const PROJECT = 'project';
    const API_URL = 'api_url';

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
     * @var string
     */
    protected $oauthUrl = 'https://auth.sphere.io/oauth/token';

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
    public function getOauthUrl()
    {
        return $this->oauthUrl;
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
        if (is_null($this->getClientId())) {
            throw new InvalidArgumentException(Message::NO_CLIENT_ID);
        }

        if (is_null($this->getClientSecret())) {
            throw new InvalidArgumentException(Message::NO_CLIENT_SECRET);
        }

        if (is_null($this->getProject())) {
            throw new InvalidArgumentException(Message::NO_PROJECT_ID);
        }

        return true;
    }

    /**
     * @return int
     */
    public function getBatchPoolSize()
    {
        return $this->batchPoolSize;
    }

    /**
     * @param int $batchPoolSize
     */
    public function setBatchPoolSize($batchPoolSize)
    {
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
     */
    public function setThrowExceptions($throwExceptions)
    {
        $this->throwExceptions = $throwExceptions;

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
}
