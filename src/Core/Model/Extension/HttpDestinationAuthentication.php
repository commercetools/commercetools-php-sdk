<?php
/**
 */

namespace Commercetools\Core\Model\Extension;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Extension
 *
 * @method string getType()
 * @method HttpDestinationAuthentication setType(string $type = null)
 */
class HttpDestinationAuthentication extends JsonObject
{
    const AUTH_TYPE = null;
    const AUTH_AUTHORIZATION_HEADER = 'AuthorizationHeader';
    const AUTH_AZURE_FUNCTIONS = 'AzureFunctions';

    /**
     * @inheritDoc
     */
    public function __construct(array $data = [], $context = null)
    {
        if (!is_null(static::AUTH_TYPE)) {
            $data[static::TYPE] = static::AUTH_TYPE;
        }
        parent::__construct($data, $context);
    }

    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string'],
        ];
    }

    protected static function authType($typeId)
    {
        $types = [
            static::AUTH_AUTHORIZATION_HEADER => AuthorizationHeaderAuthentication::class,
            static::AUTH_AZURE_FUNCTIONS => AzureFunctionsAuthentication::class,
        ];
        return isset($types[$typeId]) ? $types[$typeId] : Destination::class;
    }

    public static function fromArray(array $data, $context = null)
    {
        if (get_called_class() == HttpDestinationAuthentication::class && isset($data[static::TYPE])) {
            $className = static::authType($data[static::TYPE]);
            if (class_exists($className)) {
                return new $className($data, $context);
            }
        }
        return new static($data, $context);
    }
}
