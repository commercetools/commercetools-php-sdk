<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 22.01.15, 11:41
 */

namespace Sphere\Core\Client\OAuth;


/**
 * @package Sphere\Core\OAuth
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

    public function __construct($token = null, $ttl = null)
    {
        $this->setToken($token)->setTtl($ttl);
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
     */
    public function setTtl($ttl)
    {
        $this->ttl = $ttl;

        return $this;
    }
}
