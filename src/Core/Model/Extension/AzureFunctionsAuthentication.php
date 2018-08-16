<?php
/**
 */

namespace Commercetools\Core\Model\Extension;

/**
 * @package Commercetools\Core\Model\Extension
 *
 * @method string getType()
 * @method AzureFunctionsAuthentication setType(string $type = null)
 * @method string getKey()
 * @method AzureFunctionsAuthentication setKey(string $key = null)
 */
class AzureFunctionsAuthentication extends HttpDestinationAuthentication
{
    const AUTH_TYPE = self::AUTH_AZURE_FUNCTIONS;

    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string'],
            'key' => [static::TYPE => 'string']
        ];
    }
}
