<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 04.02.15, 17:46
 */

namespace Commercetools\Core\Model\Common;

use Commercetools\Core\Model\ProductType\AttributeDefinition;
use Commercetools\Core\Model\ProductType\AttributeType;

/**
 * @package Commercetools\Core\Model\Common
 * @link https://dev.commercetools.com/http-api-projects-products.html#product-variant-attribute
 * @method string getName()
 * @method getValue()
 * @method Attribute setName(string $name = null)
 * @method Attribute setValue($value = null)
 */
class Attribute extends JsonObject
{
    // identifiers for the Api Product Attribute Types:
    const T_UNKNOWN = 'unknown';  // zero, should evaluate to false

    const PROP_VALUE = "value";
    const PROP_KEY = "key";
    const PROP_NAME = "name";
    const PROP_CURRENCY_CODE = "currencyCode";
    const PROP_CENT_AMOUNT = "centAmount";
    const PROP_TYPE_ID = "typeId";
    const PROP_ID = "id";
    const PROP_LABEL = "label";

    const API_BOOL = 'boolean';
    const API_NUMBER = 'number';
    const API_TEXT = 'text';
    const API_LTEXT = 'ltext';
    const API_LENUM = 'lenum';
    const API_ENUM = 'enum';
    const API_MONEY = 'money';
    const API_DATE = 'date';
    const API_TIME = 'time';
    const API_DATETIME = 'datetime';
    const API_SET = 'set';
    const API_NESTED = 'nested';
    const API_REFERENCE = 'reference';

    protected static $types = [];

    public function fieldDefinitions()
    {
        return [
            static::PROP_NAME => [self::TYPE => 'string'],
            static::PROP_VALUE => [],
        ];
    }

    public function fieldDefinition($field)
    {
        if ($field == static::PROP_VALUE) {
            if (isset(static::$types[$this->getName()])) {
                $fieldDefinition = static::$types[$this->getName()];
                if (!$fieldDefinition instanceof AttributeDefinition) {
                    return null;
                }
                $fieldType = $fieldDefinition->getType();
                if (!$fieldType instanceof AttributeType) {
                    return null;
                }
                return $fieldType->fieldTypeDefinition();
            }
            return null;
        }
        return parent::fieldDefinition($field);
    }

    /**
     * @param $attributeName
     * @param $value
     * @return mixed
     */
    protected function getApiType($attributeName, $value)
    {
        if (isset(static::$types[$attributeName])) {
            return static::$types[$attributeName];
        }

        $apiType = $this->guessApiType($value);
        $definition = AttributeDefinition::of($this->getContextCallback());
        $definition->setName($attributeName);
        $definition->setType(AttributeType::fromArray(['name' => $apiType]));

        if ($apiType == static::API_SET) {
            $elementType = $this->guessApiType(current($value));
            $definition->getType()->setElementType(AttributeType::fromArray(['name' => $elementType]));
        }
        $this->setAttributeDefinition($definition);
        return static::$types[$attributeName];
    }

    /**
     * @param AttributeDefinition $definition
     * @return $this
     */
    public function setAttributeDefinition(AttributeDefinition $definition)
    {
        static::$types[$definition->getName()] = $definition;

        return $this;
    }

    /**
     * @param string $field
     */
    protected function initialize($field)
    {
        if ($field == static::PROP_VALUE) {
            $name = $this->getRaw(static::PROP_NAME);
            $value = $this->getRaw(static::PROP_VALUE);
            $this->getApiType($name, $value);
        }
        parent::initialize($field);
    }

    /**
     * @param $value
     * @return string
     */
    protected function guessApiType($value)
    {
        $map = [
            'guessUnknown',
            'guessBool',
            'guessTextLike',
            'guessNumber',
            'guessEnum',
            'guessLocalizedEnum',
            'guessMoney',
            'guessReference',
            'guessLocalizedText',
            'guessNested',
            'guessSet',
        ];

        foreach ($map as $function) {
            if ($type = $this->$function($value)) {
                return $type;
            }
        }

        return static::T_UNKNOWN;
    }

    /**
     * @param $value
     * @param string[] $keys
     * @return bool
     */
    protected function hasKeys($value, $keys)
    {
        if (!is_array($value)) {
            return false;
        }
        $intersect = array_intersect_key(array_flip($keys), $value);
        return (count($intersect) == count($keys));
    }

    protected function guessUnknown($value)
    {
        return (!isset($value) ? static::T_UNKNOWN : null);
    }

    protected function guessTextLike($value)
    {
        return is_string($value) ? static::API_TEXT : null;
    }

    protected function guessBool($value)
    {
        return is_bool($value) ? static::API_BOOL : null;
    }

    protected function guessNumber($value)
    {
        return is_numeric($value) ? static::API_NUMBER : null;
    }

    protected function guessEnum($value)
    {
        if ($this->hasKeys($value, [static::PROP_KEY, static::PROP_LABEL]) && is_string($value[static::PROP_LABEL])) {
            return static::API_ENUM;
        }

        return null;
    }

    protected function guessLocalizedEnum($value)
    {
        if ($this->hasKeys($value, [static::PROP_KEY, static::PROP_LABEL]) && is_array($value[static::PROP_LABEL])) {
            return static::API_LENUM;
        }

        return null;
    }

    protected function guessMoney($value)
    {
        if ($this->hasKeys($value, [static::PROP_CENT_AMOUNT, static::PROP_CURRENCY_CODE])) {
            return static::API_MONEY;
        }

        return null;
    }

    protected function guessReference($value)
    {
        if ($this->hasKeys($value, [static::PROP_TYPE_ID, static::PROP_ID])) {
            return static::API_REFERENCE;
        }

        return null;
    }

    protected function guessLocalizedText($value)
    {
        if (is_array($value) && !is_numeric(key($value))) {
            return static::API_LTEXT;
        }

        return null;
    }

    protected function guessSet($value)
    {
        if (is_array($value)) {
            return static::API_SET;
        }

        return null;
    }

    protected function guessNested($value)
    {
        if (is_array($value)) {
            $first = reset($value);
            if ($this->hasKeys($first, [static::PROP_NAME, static::PROP_VALUE])) {
                return static::API_NESTED;
            }
        }

        return null;
    }
}
