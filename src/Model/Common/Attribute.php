<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 17:46
 */

namespace Sphere\Core\Model\Common;


/**
 * Class Attribute
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

    const PROP_VALUE = "value";
    const PROP_KEY = "key";
    const PROP_NAME = "name";
    const PROP_CURRENCYCODE = "currencyCode";
    const PROP_CENTAMOUNT = "centAmount";
    const PROP_TYPEID = "typeId";
    const PROP_ID = "id";
    const PROP_LABEL = "label";

    protected static $types = [];

    public function getFields()
    {
        return [
            'name' => [self::TYPE => 'string'],
            'value' => [self::OPTIONAL => true],
        ];
    }

    /**
     * @param $field
     * @param $value
     * @return mixed
     * @internal
     */
    public function getSphereType($field, $value)
    {
        if (isset(static::$types[$field])) {
            return static::$types[$field];
        }
        static::$types[$field] = $this->guessSphereType($value);

        return static::$types[$field];
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

    protected function initialize($field)
    {
        if ($field == static::PROP_VALUE) {
            $name = $this->getRaw(static::PROP_NAME);
            $value = $this->getRaw(static::PROP_VALUE);
            $type = $this->getSphereType($name, $value);

            if ($type !== false && $type != static::T_UNKNOWN && $this->hasInterface($type)) {
                if ($type == static::T_SET) {
                    $setType = $this->getSphereType('set-' . $name, current($value));
                    $this->typeData[$field] = Set::ofType($setType)->setRawData($value);
                } else {
                    /**
                     * @var JsonDeserializeInterface $type
                     */
                    $this->typeData[$field] = $type::fromArray($value, $this->getContextCallback());
                }
            } else {
                $this->typeData[$field] = $value;
            }
            $this->initialized[$field] = true;
        } else {
            parent::initialize($field);
        }
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
        return is_string($value) ? static::T_TEXTLIKE : null;
    }

    protected function guessBool($value)
    {
        return is_bool($value) ? static::T_BOOLEAN : null;
    }

    protected function guessNumber($value)
    {
        return is_numeric($value) ? static::T_NUMBER : null;
    }

    protected function guessEnum($value)
    {
        if ($this->hasKeys($value, [static::PROP_KEY, static::PROP_LABEL]) && is_string($value[static::PROP_LABEL])) {
            return static::T_ENUM;
        }

        return null;
    }

    protected function guessLocalizedEnum($value)
    {
        if ($this->hasKeys($value, [static::PROP_KEY, static::PROP_LABEL]) && is_array($value[static::PROP_LABEL])) {
            return static::T_LENUM;
        }

        return null;
    }

    protected function guessMoney($value)
    {
        if ($this->hasKeys($value, [static::PROP_CENTAMOUNT, static::PROP_CURRENCYCODE])) {
            return static::T_MONEY;
        }

        return null;
    }

    protected function guessReference($value)
    {
        if ($this->hasKeys($value, [static::PROP_TYPEID, static::PROP_ID])) {
            return static::T_REFERENCE;
        }

        return null;
    }

    protected function guessLocalizedText($value)
    {
        if (is_array($value) && !is_numeric(key($value))) {
            return static::T_LTEXT;
        }

        return null;
    }

    protected function guessSet($value)
    {
        if (is_array($value)) {
            return static::T_SET;
        }

        return null;
    }

    protected function guessNested($value)
    {
        if (is_array($value)) {
            $first = reset($value);
            if ($this->hasKeys($first, [static::PROP_NAME, static::PROP_VALUE])) {
                return static::T_NESTED;
            }
        }

        return null;
    }
}
