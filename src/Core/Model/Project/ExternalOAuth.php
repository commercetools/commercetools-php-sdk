<?php

namespace Commercetools\Core\Model\Project;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedEnumCollection;

/**
 * @package Commercetools\Core\Model\Project
 * @link https://docs.commercetools.com/http-api-projects-project.html#externaloauth
 * @method string getUrl()
 * @method ExternalOAuth setUrl(string $url = null)
 * @method string getAuthorizationHeader()
 * @method ExternalOAuth setAuthorizationHeader(string $authorizationHeader = null)
 */
class ExternalOAuth extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'url' => [static::TYPE => 'string'],
            'authorizationHeader' => [static::TYPE => 'string']
        ];
    }
}
