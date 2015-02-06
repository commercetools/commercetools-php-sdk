<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 17:46
 */

namespace Sphere\Core\Model\Common;

use Sphere\Core\Model\OfTrait;

/**
 * Class Attribute
 * @package Sphere\Core\Model\Type
 * @method static Attribute of($name, $value)
 * @method string getName()
 * @method \JsonSerializable getValue()
 * @method Attribute setName(string $name)
 * @method Attribute setValue($value = null)
 */
class Attribute extends JsonObject
{
    use OfTrait;

    public function getFields()
    {
        return [
            'name' => [self::TYPE => 'string'],
            'value' => [self::TYPE => '\JsonSerializable', self::OPTIONAL => true],
        ];
    }

    public function __construct($name, \JsonSerializable $value = null)
    {
        $this->setName($name);
        $this->setValue($value);
    }
}
