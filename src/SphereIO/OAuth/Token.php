<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 22.01.15, 11:41
 */

namespace SphereIO\OAuth;


class Token
{
    protected $token;
    protected $validTo;

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getValidTo()
    {
        return $this->validTo;
    }

    /**
     * @param mixed $validTo
     */
    public function setValidTo($validTo)
    {
        $this->validTo = $validTo;
    }
}
