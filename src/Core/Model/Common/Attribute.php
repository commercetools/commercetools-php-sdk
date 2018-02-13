<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 04.02.15, 17:46
 */

namespace Commercetools\Core\Model\Common;

use Commercetools\Core\Model\ProductType\AttributeDefinition;
use Commercetools\Core\Model\ProductType\AttributeType;
use Commercetools\Core\Model\ProductType\SetType;

/**
 * @package Commercetools\Core\Model\Common
 * @link https://docs.commercetools.com/http-api-projects-products.html#attribute
 * @method string getName()
 * @method Attribute setName(string $name = null)
 * @method mixed getValue()
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
            static::PROP_NAME => [static::TYPE => 'string'],
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
        $elementType = null;
        if ($apiType == static::API_SET) {
            $elementType = $this->guessApiType(current($value));
        }
        $this->setApiType($attributeName, $apiType, $elementType);

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

    private function setApiType($attributeName, $valueType, $elementType = null)
    {
        if (!isset(static::$types[$attributeName])) {
            $attributeType = AttributeType::fromArray(['name' => $valueType]);
            if ($attributeType instanceof SetType && $elementType != null) {
                $attributeType->setElementType(AttributeType::fromArray(['name' => $elementType]));
            }

            $definition = AttributeDefinition::of($this->getContextCallback());
            $definition->setName($attributeName);
            $definition->setType($attributeType);
            $this->setAttributeDefinition($definition);
        }
    }

    /**
     * @return bool
     */
    public function getValueAsBool()
    {
        $attributeName = $this->getName();
        $this->setApiType($attributeName, static::API_BOOL);
        return $this->getValue();
    }

    /**
     * @return int|float
     */
    public function getValueAsNumber()
    {
        $attributeName = $this->getName();
        $this->setApiType($attributeName, static::API_NUMBER);
        return $this->getValue();
    }

    /**
     * @return string
     */
    public function getValueAsString()
    {
        $attributeName = $this->getName();
        $this->setApiType($attributeName, static::API_TEXT);
        return $this->getValue();
    }

    /**
     * @return LocalizedString
     */
    public function getValueAsLocalizedString()
    {
        $attributeName = $this->getName();
        $this->setApiType($attributeName, static::API_LTEXT);
        return $this->getValue();
    }

    /**
     * @return LocalizedEnum
     */
    public function getValueAsLocalizedEnum()
    {
        $attributeName = $this->getName();
        $this->setApiType($attributeName, static::API_LENUM);
        return $this->getValue();
    }

    /**
     * @return Enum
     */
    public function getValueAsEnum()
    {
        $attributeName = $this->getName();
        $this->setApiType($attributeName, static::API_ENUM);
        return $this->getValue();
    }

    /**
     * @return Money
     */
    public function getValueAsMoney()
    {
        $attributeName = $this->getName();
        $this->setApiType($attributeName, static::API_MONEY);
        return $this->getValue();
    }

    /**
     * @return DateDecorator
     */
    public function getValueAsDate()
    {
        $attributeName = $this->getName();
        $this->setApiType($attributeName, static::API_DATE);
        return $this->getValue();
    }

    /**
     * @return TimeDecorator
     */
    public function getValueAsTime()
    {
        $attributeName = $this->getName();
        $this->setApiType($attributeName, static::API_TIME);
        return $this->getValue();
    }

    /**
     * @return DateTimeDecorator
     */
    public function getValueAsDateTime()
    {
        $attributeName = $this->getName();
        $this->setApiType($attributeName, static::API_DATETIME);
        return $this->getValue();
    }

    /**
     * @return AttributeCollection
     */
    public function getValueAsNested()
    {
        $attributeName = $this->getName();
        $this->setApiType($attributeName, static::API_NESTED);
        return $this->getValue();
    }

    /**
     * @return Reference
     */
    public function getValueAsReference()
    {
        $attributeName = $this->getName();
        $this->setApiType($attributeName, static::API_REFERENCE);
        return $this->getValue();
    }

    /**
     * @return Set
     */
    public function getValueAsBoolSet()
    {
        $attributeName = $this->getName();
        $this->setApiType($attributeName, static::API_SET, static::API_BOOL);
        return $this->getValue();
    }

    /**
     * @return Set
     */
    public function getValueAsNumberSet()
    {
        $attributeName = $this->getName();
        $this->setApiType($attributeName, static::API_SET, static::API_NUMBER);
        return $this->getValue();
    }

    /**
     * @return Set
     */
    public function getValueAsStringSet()
    {
        $attributeName = $this->getName();
        $this->setApiType($attributeName, static::API_SET, static::API_TEXT);
        return $this->getValue();
    }

    /**
     * @return Set
     */
    public function getValueAsLocalizedStringSet()
    {
        $attributeName = $this->getName();
        $this->setApiType($attributeName, static::API_SET, static::API_LTEXT);
        return $this->getValue();
    }

    /**
     * @return Set
     */
    public function getValueAsLocalizedEnumSet()
    {
        $attributeName = $this->getName();
        $this->setApiType($attributeName, static::API_SET, static::API_LENUM);
        return $this->getValue();
    }

    /**
     * @return Set
     */
    public function getValueAsEnumSet()
    {
        $attributeName = $this->getName();
        $this->setApiType($attributeName, static::API_SET, static::API_ENUM);
        return $this->getValue();
    }

    /**
     * @return Set
     */
    public function getValueAsMoneySet()
    {
        $attributeName = $this->getName();
        $this->setApiType($attributeName, static::API_SET, static::API_MONEY);
        return $this->getValue();
    }

    /**
     * @return Set
     */
    public function getValueAsDateSet()
    {
        $attributeName = $this->getName();
        $this->setApiType($attributeName, static::API_SET, static::API_DATE);
        return $this->getValue();
    }

    /**
     * @return Set
     */
    public function getValueAsTimeSet()
    {
        $attributeName = $this->getName();
        $this->setApiType($attributeName, static::API_SET, static::API_TIME);
        return $this->getValue();
    }

    /**
     * @return Set
     */
    public function getValueAsDateTimeSet()
    {
        $attributeName = $this->getName();
        $this->setApiType($attributeName, static::API_SET, static::API_DATETIME);
        return $this->getValue();
    }

    /**
     * @return Set
     */
    public function getValueAsNestedSet()
    {
        $attributeName = $this->getName();
        $this->setApiType($attributeName, static::API_SET, static::API_NESTED);
        return $this->getValue();
    }

    /**
     * @return Set
     */
    public function getValueAsReferenceSet()
    {
        $attributeName = $this->getName();
        $this->setApiType($attributeName, static::API_SET, static::API_REFERENCE);
        return $this->getValue();
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
