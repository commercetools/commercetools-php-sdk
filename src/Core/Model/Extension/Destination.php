<?php
/**
 */

namespace Commercetools\Core\Model\Extension;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Extension
 *
 * @method string getType()
 * @method Destination setType(string $type = null)
 */
class Destination extends JsonObject
{
    const DESTINATION_TYPE = null;
    const DESTINATION_HTTP = 'HTTP';
    const DESTINATION_AWS_LAMBDA = 'AWSLambda';

    /**
     * @inheritDoc
     */
    public function __construct(array $data = [], $context = null)
    {
        if (!is_null(static::DESTINATION_TYPE)) {
            $data[static::TYPE] = static::DESTINATION_TYPE;
        }
        parent::__construct($data, $context);
    }

    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string'],
        ];
    }

    protected static function destinationType($typeId)
    {
        $types = [
            static::DESTINATION_HTTP => HttpDestination::class,
            static::DESTINATION_AWS_LAMBDA => AWSLambdaDestination::class,
        ];
        return isset($types[$typeId]) ? $types[$typeId] : Destination::class;
    }

    public static function fromArray(array $data, $context = null)
    {
        if (get_called_class() == Destination::class && isset($data[static::TYPE])) {
            $className = static::destinationType($data[static::TYPE]);
            if (class_exists($className)) {
                return new $className($data, $context);
            }
        }
        return new static($data, $context);
    }
}
