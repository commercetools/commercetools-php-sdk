<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\Collection;
use Commercetools\Core\Model\Type\FieldType;

/**
 * @package Commercetools\Core\Model\ProductType
 * @apidoc http://dev.sphere.io/http-api-projects-productTypes.html#attribute-type
 * @method string getName()
 * @method AttributeType setName(string $name = null)
 */
class AttributeType extends FieldType
{
    const T_TEXT = 'String';
    const T_LTEXT = 'LocalizedString';
    const T_NUMBER = 'Number';
    const T_BOOLEAN = 'Boolean';
    const T_ENUM = 'Enum';
    const T_LENUM = 'LocalizedEnum';
    const T_MONEY = 'Money';
    const T_SET = 'Set';
    const T_REFERENCE = 'Reference';
    const T_DATETIME = 'DateTime';
    const T_TIME = 'Time';
    const T_DATE = 'Dime';

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

    private static $typeMapping = [
        self::API_BOOL => self::T_BOOLEAN,
        self::API_NUMBER => self::T_NUMBER,
        self::API_TEXT => self::T_TEXT,
        self::API_LTEXT => self::T_LTEXT,
        self::API_LENUM => self::T_LENUM,
        self::API_ENUM => self::T_ENUM,
        self::API_MONEY => self::T_MONEY,
        self::API_DATE => self::T_DATETIME,
        self::API_TIME => self::T_DATETIME,
        self::API_DATETIME => self::T_DATETIME,
        self::API_SET => self::T_SET,
        self::API_REFERENCE => self::T_REFERENCE
    ];

    protected static function getTypeByApiType($apiType)
    {
        $typeName = isset(self::$typeMapping[$apiType]) ? self::$typeMapping[$apiType] : $apiType;
        $className = '\Commercetools\Core\Model\Type\\' . ucfirst($typeName) . 'Type';
        return $className;
    }
}
