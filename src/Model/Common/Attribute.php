<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 17:46
 */

namespace Sphere\Core\Model\Common;

use Sphere\Core\Model\Common\OfTrait;

/**
 * Class Attribute
 * @package Sphere\Core\Model\Common
 * @method static Attribute of($name, $value)
 * @method string getName()
 * @method \JsonSerializable getValue()
 * @method Attribute setName(string $name)
 * @method Attribute setValue(\JsonSerializable $value = null)
 */
class Attribute extends JsonObject
{
    use OfTrait;

    // identifiers for the SPHERE.IO Product Attribute Types:
    const T_UNKNOWN = 'unknown';  // zero, should evaluate to false
    const T_TEXTLIKE = 'text_like'; //includes date, datetime, time as these are JSON Strings, too
    const T_LTEXT = 'localized_text';
    const T_NUMBER = 'number';
    const T_BOOLEAN = 'bool';
    const T_ENUM = 'enum';
    const T_LENUM = 'localized_enum';
    const T_MONEY = 'money';
    const T_SET = 'set';
    const T_NESTED = 'nested';
    const T_REFERENCE = 'reference';

    const PROP_VALUE = "value";
    const PROP_KEY = "key";
    const PROP_NAME = "name";
    const PROP_CURRENCYCODE = "currencyCode";
    const PROP_CENTAMOUNT = "centAmount";
    const PROP_TYPEID = "typeId";
    const PROP_ID = "id";
    const PROP_LABEL = "label";

    protected $sphereType;

    public function getFields()
    {
        return [
            'name' => [self::TYPE => 'string'],
            'value' => [self::TYPE => '\JsonSerializable', self::OPTIONAL => true],
        ];
    }

    /**
     * @param string $name
     * @param \JsonSerializable $value
     * @param Context $context
     */
    public function __construct($name, \JsonSerializable $value = null, Context $context = null)
    {
        $this->setContext($context);
        $this->setName($name);
        $this->setValue($value);
    }

    /**
     * @param array $data
     * @param Context $context
     * @return static
     */
    public static function fromArray(array $data, Context $context = null)
    {
        return new static(
            $data['name'],
            $data['value'],
            $context
        );
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

//    protected static function guessSphereType($value)
//    {
//        if (!isset($value)) {
//            return static::T_UNKNOWN;
//        }
//        if (is_string($value)) {
//            return static::T_TEXTLIKE;
//            /* if we accept the performance hit and the ambiguity
//             * (a SPHERE String can by chance contain something that
//             * matches a date / time / datetime) we can detect de-facto date / time / datetime this way:
//             *   ^\d{4}-\d{2}-\d{2}$ T_DATE
//             *   ^\d{2}:\d{2}:\d{2}.\d{3}$  T_TIME
//             *   ^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}.\d{3}Z$  T_DATETIME
//             */
//        }
//        if (is_bool($value)) {
//            return static::T_BOOLEAN;
//        }
//        // is_numeric is harmless because we have already checked the string case above
//        if (is_numeric($value)) {
//            return static::T_NUMBER;
//
//        }
//        if (is_array($value)) {  // JSON Object
//            if (static::isAssoc($value)) {
//                if (isset($value[static::PROP_KEY])
//                && isset($value[static::PROP_LABEL])) {
//                    if (is_string($value[static::PROP_LABEL])) {
//                        return static::T_ENUM;
//                    } elseif (is_array($value[static::PROP_LABEL])) {
//                        return static::T_LENUM;
//                    } else {
//                        return static::T_UNKNOWN;
//                    }
//                } elseif (isset($value[static::PROP_CENTAMOUNT]) && isset($value[static::PROP_CURRENCYCODE])) {
//                    return static::T_MONEY;
//                } elseif (isset($value[static::PROP_TYPEID]) && isset($value[static::PROP_ID])) {
//                    return static::T_REFERENCE;
//                } else {
//                    return static::T_LTEXT;
//                }
//            }
//        } else { // JSON Array
//            $first = reset($value);
//            if (isset($first[static::PROP_NAME]) && isset($first[static::PROP_VALUE])) {
//                return static::T_NESTED;
//            } else {
//                return static::T_SET;
//            }
//        }
//        return static::T_UNKNOWN;
//    }

//    // https://gist.github.com/Thinkscape/1965669
//    protected function isAssoc($array)
//    {
//        return ($array !== array_values($array));
//    }

    // todo make logic reusable
    public function __toString()
    {
        if (is_null($this->sphereType)) {
            $this->sphereType = $this->guessSphereType($this->rawData[static::PROP_VALUE]);
        }
        // primitives first:
        // TODO split into String and others and cast the others to String
        // TODO Number should be formatted according to locale (which is not in context yet?)
        if (in_array($this->sphereType, [static::T_TEXTLIKE, static::T_BOOLEAN, static::T_NUMBER])) {
            return $this->rawData[static::PROP_VALUE];
        }
        // enum is a "keyed primitive":
        if ($this->sphereType === static::T_ENUM) {
            return $this->rawData[static::PROP_VALUE][static::PROP_LABEL];
        }
        // $localizedText creates a value object of Type LocalizedText
        if ($this->sphereType === static::T_LTEXT) {
            $localizedText = new LocalizedString($this->rawData[static::PROP_VALUE], $this->getContext());
            $this->typeData[static::PROP_VALUE] = $localizedText;
            return $localizedText->getLocalized();
        }
        // $localizedEnum is analogous but inside the key (TODO deduplicate):
        if ($this->sphereType === static::T_LENUM) {
            $localizedEnum = new LocalizedString(
                $this->rawData[static::PROP_VALUE][static::PROP_LABEL],
                $this->getContext()
            );
            $this->typeData[static::PROP_VALUE] = $localizedEnum;
            return $localizedEnum->getLocalized();
        }
        // TODO money -> create Money Class as value. Add __toString to Money class
        // TODO and use locale info from context with NumberFormatter::formatCurrency
        // TODO reference -> create Reference Class as value
        // TODO (does that expand if "obj" is there via reference expansion?)
        // TODO nested -> create AttributeCollection Class as value
        // TODO set -> tricky case. have to do a second guessSphereType on the first array entry (which directly is
        //             the "value" part of an Attribute) and call this __toString again. requires refactoring!


        return ""; // @todo non graceful mode
    }

    protected function hasKeys($value, $keys)
    {
        if (!is_array($value)) {
            return false;
        }
        $intersect = array_intersect_key($keys, $value);

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
        if ($this->hasKeys($value, [static::PROP_KEY, static::PROP_VALUE]) && is_string($value[static::PROP_VALUE])) {
            return static::T_ENUM;
        }

        return null;
    }

    protected function guessLocalizedEnum($value)
    {
        if ($this->hasKeys($value, [static::PROP_KEY, static::PROP_VALUE]) && is_array($value[static::PROP_VALUE])) {
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
