<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 22.01.15, 11:41
 */

namespace Sphere\Core\OAuth;


class Token
{
    protected $token;
    protected $validTo;
    protected $ttl;

    public function __construct($token = null, $ttl = null)
    {
        $this->token = $token;
        $this->ttl = $ttl;
    }

    /**
     * @return mixed
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
     * @return mixed
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
     * @return null
     */
    public function getTtl()
    {
        return $this->ttl;
    }

    /**
     * @param null $ttl
     */
    public function setTtl($ttl)
    {
        $this->ttl = $ttl;
    }
}
