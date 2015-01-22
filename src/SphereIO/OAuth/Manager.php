<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 22.01.15, 12:34
 */

namespace SphereIO\OAuth;


use SphereIO\AbstractHttpClient;
use SphereIO\Cache\CacheAdapterInterface;
use SphereIO\Config;

class Manager extends AbstractHttpClient
{
    const ACCESS_TOKEN = 'access_token';
    const EXPIRES_IN = 'expires_in';
    const ERROR = 'error';
    const ERROR_DESCRIPTION = 'error_description';

    /**
     * @var Config
     */
    protected $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @return Config
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @return Token
     * @throws AuthorizeException
     */
    public function getToken()
    {
        return $this->getBearerToken();
    }

    /**
     * @param string $scope
     * @return Token
     * @throws AuthorizeException
     */
    protected function getBearerToken($scope = 'manage_project')
    {
        $data = [
            'grant_type' => 'client_credentials',
            'scope' => $scope . ':' . $this->getConfig()->getProject()
        ];

        $result = $this->getHttpClient()->post(
            $this->getConfig()->getOauthUrl(),
            [
                'body' => $data,
                'auth' => [$this->getConfig()->getClientId(), $this->getConfig()->getClientSecret()]
            ]
        )->json();

        if (isset($result[static::ERROR])) {
            $message = isset($result[static::ERROR_DESCRIPTION]) ? $result[static::ERROR_DESCRIPTION] : $result[static::ERROR];
            throw new AuthorizeException($message);
        }

        $token = new Token();
        $token->setToken($result[static::ACCESS_TOKEN]);
        $token->setValidTo(new \DateTime('now +' . $result[static::EXPIRES_IN] . ' seconds'));

        return $token;
    }
}
