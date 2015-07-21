<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 17:46
 */

namespace Sphere\Core\Model\Common;

use Sphere\Core\Model\ProductType\AttributeDefinition;
use Sphere\Core\Model\ProductType\AttributeType;

/**
 * @package Sphere\Core\Model\Common
 * @link http://dev.sphere.io/http-api-projects-products.html#product-variant-attribute
 * @method string getName()
 * @method getValue()
 * @method Attribute setName(string $name = null)
 * @method Attribute setValue($value = null)
 */
class Attribute extends JsonObject
{
    // identifiers for the SPHERE.IO Product Attribute Types:
    const T_UNKNOWN = 'unknown';  // zero, should evaluate to false
    const T_TEXTLIKE = 'string'; //includes date, datetime, time as these are JSON Strings, too
    const T_LTEXT = '\Sphere\Core\Model\Common\LocalizedString';
    const T_NUMBER = 'float';
    const T_BOOLEAN = 'bool';
    const T_ENUM = '\Sphere\Core\Model\Common\Enum';
    const T_LENUM = '\Sphere\Core\Model\Common\LocalizedEnum';
    const T_MONEY = '\Sphere\Core\Model\Common\Money';
    const T_SET = '\Sphere\Core\Model\Common\Set';
    const T_NESTED = '\Sphere\Core\Model\Common\AttributeCollection';
    const T_REFERENCE = '\Sphere\Core\Model\Common\Reference';
    const T_DATETIME = '\DateTime';
    const T_DATETIME_DECORATOR = '\Sphere\Core\Model\Common\DateTimeDecorator';


    const PROP_VALUE = "value";
    const PROP_KEY = "key";
    const PROP_NAME = "name";
    const PROP_CURRENCY_CODE = "currencyCode";
    const PROP_CENT_AMOUNT = "centAmount";
    const PROP_TYPE_ID = "typeId";
    const PROP_ID = "id";
    const PROP_LABEL = "label";

    const SPHERE_BOOL = 'boolean';
    const SPHERE_NUMBER = 'number';
    const SPHERE_TEXT = 'text';
    const SPHERE_LTEXT = 'ltext';
    const SPHERE_LENUM = 'lenum';
    const SPHERE_ENUM = 'enum';
    const SPHERE_MONEY = 'money';
    const SPHERE_DATE = 'date';
    const SPHERE_TIME = 'time';
    const SPHERE_DATETIME = 'datetime';
    const SPHERE_SET = 'set';
    const SPHERE_NESTED = 'nested';
    const SPHERE_REFERENCE = 'reference';

    protected static $types = [];

    protected $attributeDefinition;
    protected $valueType;
    protected $valueElementType;
    protected $valueDecorator;

    public function getFields()
    {
        return [
            static::PROP_NAME => [self::TYPE => 'string'],
            static::PROP_VALUE => [
                self::TYPE => $this->valueType,
                self::DECORATOR => $this->valueDecorator,
                self::ELEMENT_TYPE => $this->valueElementType,
                self::OPTIONAL => true
            ],
        ];
    }

    /**
     * @param $attributeName
     * @param $value
     * @return mixed
     */
    protected function getSphereType($attributeName, $value)
    {
        if (isset(static::$types[$attributeName])) {
            $this->setAttributeDefinition(static::$types[$attributeName]);
            return static::$types[$attributeName];
        }

        $sphereType = $this->guessSphereType($value);
        $definition = AttributeDefinition::of($this->getContextCallback());
        $definition->setName($attributeName);
        $definition->setType(AttributeType::of()->setName($sphereType));

        if ($sphereType == static::SPHERE_SET) {
            $elementType = $this->guessSphereType(current($value));
            $definition->getType()->setElementType(AttributeType::of()->setName($elementType));
        }
        $this->setAttributeDefinition($definition);
        static::$types[$attributeName] = $definition;

        return static::$types[$attributeName];
    }

    protected function getTypeBySphereType($sphereType)
    {
        $typeMapping = [
            static::SPHERE_BOOL => static::T_BOOLEAN,
            static::SPHERE_NUMBER => static::T_NUMBER,
            static::SPHERE_TEXT => static::T_TEXTLIKE,
            static::SPHERE_LTEXT => static::T_LTEXT,
            static::SPHERE_LENUM => static::T_LENUM,
            static::SPHERE_ENUM => static::T_ENUM,
            static::SPHERE_MONEY => static::T_MONEY,
            static::SPHERE_DATE => static::T_DATETIME,
            static::SPHERE_TIME => static::T_DATETIME,
            static::SPHERE_DATETIME => static::T_DATETIME,
            static::SPHERE_SET => static::T_SET,
            static::SPHERE_NESTED => static::T_NESTED,
            static::SPHERE_REFERENCE => static::T_REFERENCE
        ];


        return isset($typeMapping[$sphereType]) ? $typeMapping[$sphereType] : null;
    }

    /**
     * @param AttributeDefinition $definition
     * @return $this
     */
    public function setAttributeDefinition(AttributeDefinition $definition)
    {
        static::$types[$definition->getName()] = $definition;
        $this->attributeDefinition = $definition;
        $sphereType = $definition->getType()->getName();
        $this->valueType = $this->getTypeBySphereType($sphereType);
        $this->valueElementType = null;
        $this->valueDecorator = null;

        switch ($sphereType) {
            case static::SPHERE_SET:
                $this->valueElementType = $this->getTypeBySphereType(
                    $definition->getType()->getElementType()->getName()
                );
                break;
            case static::SPHERE_TIME:
            case static::SPHERE_DATETIME:
            case static::SPHERE_DATE:
                $this->valueDecorator = static::T_DATETIME_DECORATOR;
        }

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
            $this->getSphereType($name, $value);
        }
        parent::initialize($field);
    }

    /**
     * @param $value
     * @return string
     */
    protected function guessSphereType($value)
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
        return is_string($value) ? static::SPHERE_TEXT : null;
    }

    protected function guessBool($value)
    {
        return is_bool($value) ? static::SPHERE_BOOL : null;
    }

    protected function guessNumber($value)
    {
        return is_numeric($value) ? static::SPHERE_NUMBER : null;
    }

    protected function guessEnum($value)
    {
        if ($this->hasKeys($value, [static::PROP_KEY, static::PROP_LABEL]) && is_string($value[static::PROP_LABEL])) {
            return static::SPHERE_ENUM;
        }

        return null;
    }

    protected function guessLocalizedEnum($value)
    {
        if ($this->hasKeys($value, [static::PROP_KEY, static::PROP_LABEL]) && is_array($value[static::PROP_LABEL])) {
            return static::SPHERE_LENUM;
        }

        return null;
    }

    protected function guessMoney($value)
    {
        if ($this->hasKeys($value, [static::PROP_CENT_AMOUNT, static::PROP_CURRENCY_CODE])) {
            return static::SPHERE_MONEY;
        }

        return null;
    }

    protected function guessReference($value)
    {
        if ($this->hasKeys($value, [static::PROP_TYPE_ID, static::PROP_ID])) {
            return static::SPHERE_REFERENCE;
        }

        return null;
    }

    protected function guessLocalizedText($value)
    {
        if (is_array($value) && !is_numeric(key($value))) {
            return static::SPHERE_LTEXT;
        }

        return null;
    }

    protected function guessSet($value)
    {
        if (is_array($value)) {
            return static::SPHERE_SET;
        }

        return null;
    }

    protected function guessNested($value)
    {
        if (is_array($value)) {
            $first = reset($value);
            if ($this->hasKeys($first, [static::PROP_NAME, static::PROP_VALUE])) {
                return static::SPHERE_NESTED;
            }
        }

        return null;
    }
}
