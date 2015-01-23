<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 22.01.15, 12:34
 */

namespace Sphere\Core\OAuth;


use Sphere\Core\AbstractHttpClient;
use Sphere\Core\Factory;

class Manager extends AbstractHttpClient
{
    const TOKEN_CACHE_KEY = 'sphere-io-access-token';

    const ACCESS_TOKEN = 'access_token';
    const EXPIRES_IN = 'expires_in';
    const ERROR = 'error';
    const ERROR_DESCRIPTION = 'error_description';

    protected $cacheKeys;

    public function __construct(Factory $factory)
    {
        parent::__construct($factory);
        $this->cacheKeys = [];
    }

    /**
     * @return Token
     * @throws AuthorizeException
     */
    public function getToken($scope = 'manage_project')
    {
        if ($token = $this->getCache()->fetch($this->getCacheKey($scope))) {
            return new Token($token);
        }
        $token = $this->getBearerToken($scope);
        // ensure token to be invalidated in cache before TTL
        $ttl = max(1, floor($token->getTtl()/2));
        $this->getCache()->store($this->getCacheKey($scope), $token->getToken(), $ttl);

        return $token;
    }

    /**
     * @param $scope
     * @return string
     */
    protected function getCacheKey($scope)
    {
        if (!isset($this->cacheKeys[$scope])) {
            $this->cacheKeys[$scope] = static::TOKEN_CACHE_KEY . '-' . sha1($scope . '-' . $this->getConfig()->getProject());
        }

        return $this->cacheKeys[$scope];
    }

    /**
     * @param string $scope
     * @return Token
     * @throws AuthorizeException
     */
    protected function getBearerToken($scope)
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
            $message = isset($result[static::ERROR_DESCRIPTION]) ?
                $result[static::ERROR_DESCRIPTION] : $result[static::ERROR];
            throw new AuthorizeException($message);
        }

        $token = new Token($result[static::ACCESS_TOKEN], $result[static::EXPIRES_IN]);
        $token->setValidTo(new \DateTime('now +' . $result[static::EXPIRES_IN] . ' seconds'));

        return $token;
    }
}
