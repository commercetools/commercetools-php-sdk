<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 20.01.15, 17:54
 */

namespace SphereIO;


class Config
{
    const OAUTH_URL = 'oauth_url';
    const CLIENT_ID = 'client_id';
    const CLIENT_SECRET = 'client_secret';
    const PROJECT = 'project';

    protected $clientSecret;
    protected $clientId;
    protected $project;
    protected $oauthUrl;

    public function fromArray(array $config)
    {
        $this->setClientId($config[static::CLIENT_ID])
            ->setClientSecret($config[static::CLIENT_SECRET])
            ->setProject($config[static::PROJECT])
            ->setOauthUrl($config[static::OAUTH_URL]);

        return $this;
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
}
