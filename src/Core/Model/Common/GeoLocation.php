<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 * @ramlTestIgnoreFields('coordinates')
 * @method string getType()
 * @method GeoLocation setType(string $type = null)
 * @method array getCoordinates()
 * @method GeoLocation setCoordinates(array $coordinates = null)
 */
class GeoLocation extends JsonObject
{
    const TYPE_NAME = 'Point';

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $name = static::TYPE_NAME;
        if (!empty($name)) {
            $this->setType(static::TYPE_NAME);
        }
    }

    /**
     * @return array
     */
    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string'],
            'coordinates' => [static::TYPE => 'array']
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     * @return static
     */
    public static function fromArray(array $data, $context = null)
    {
        if (isset($data['type'])) {
            $className = static::getGeoTypeByTypeName($data['type']);
            if (class_exists($className)) {
                return new $className($data, $context);
            }
        }
        return new static($data, $context);
    }

    protected static function getGeoTypeByTypeName($apiType)
    {
        $className = '\Commercetools\Core\Model\Common\\Geo' . ucfirst($apiType);
        return $className;
    }
}
