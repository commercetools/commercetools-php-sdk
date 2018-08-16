<?php
/**
 */

namespace Commercetools\Core\Model\Extension;

/**
 * @package Commercetools\Core\Model\Extension
 *
 * @method string getType()
 * @method AuthorizationHeaderAuthentication setType(string $type = null)
 * @method string getHeaderValue()
 * @method AuthorizationHeaderAuthentication setHeaderValue(string $headerValue = null)
 */
class AuthorizationHeaderAuthentication extends HttpDestinationAuthentication
{
    const AUTH_TYPE = self::AUTH_AUTHORIZATION_HEADER;

    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string'],
            'headerValue' => [static::TYPE => 'string']
        ];
    }
}
