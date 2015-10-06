<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Type;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Type
 * @method string getName()
 * @method FieldType setName(string $name = null)
 */
class FieldType extends JsonObject
{
    const NAME = '';

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $name = static::NAME;
        if (!empty($name)) {
            $this->setName(static::NAME);
        }
    }

    public function fieldDefinitions()
    {
        return [
            'name' => [static::TYPE => 'string'],
        ];
    }

    public function fieldTypeDefinition()
    {
        return [];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     * @return static
     */
    public static function fromArray(array $data, $context = null)
    {
        if (isset($data['name'])) {
            $className = static::getTypeByApiType($data['name']);
            if (class_exists($className)) {
                return new $className($data, $context);
            }
        }
        return new static($data, $context);
    }

    protected static function getTypeByApiType($apiType)
    {
        $className = '\Commercetools\Core\Model\Type\\' . ucfirst($apiType) . 'Type';
        return $className;
    }
}
