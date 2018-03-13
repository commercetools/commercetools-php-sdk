<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 22.01.15, 11:41
 */

namespace Commercetools\Core\Client\OAuth;

/**
 * @package Commercetools\Core\OAuth
 */
class Token
{
    /**
     * @var string
     */
    protected $token;

    /**
     * @var \DateTime
     */
    protected $validTo;

    /**
     * @var int
     */
    protected $ttl;

    /**
     * @var string
     */
    protected $scope;

    /**
     * @var string
     */
    protected $refreshToken;

    public function __construct($token = null, $ttl = null, $scope = null)
    {
        $this->setToken($token)->setTtl($ttl)->setScope($scope);
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getValidTo()
    {
        return $this->validTo;
    }

    /**
     * @param \DateTime $validTo
     * @return $this
     */
    public function setValidTo(\DateTime $validTo)
    {
        $this->validTo = $validTo;

        return $this;
    }

    /**
     * @return int
     */
    public function getTtl()
    {
        return $this->ttl;
    }

    /**
     * @param int $ttl
     * @return $this
     */
    public function setTtl($ttl)
    {
        $this->ttl = $ttl;

        return $this;
    }

    /**
     * @return string
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * @param string $scope
     * @return $this
     */
    public function setScope($scope)
    {
        $this->scope = $scope;

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
}
