<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Client;

use Commercetools\Core\ConfigObject;
use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Error\Message;

class Credentials extends ConfigObject
{
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

    protected $grantType = self::GRANT_TYPE_CLIENT;

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
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * @param string $clientSecret
     * @return Credentials
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
     * @return Credentials
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
     * @return Credentials
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
    public function getBearerToken()
    {
        return $this->bearerToken;
    }

    /**
     * @param string $bearerToken
     * @return Credentials
     */
    public function setBearerToken($bearerToken)
    {
        $this->bearerToken = $bearerToken;
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
}
