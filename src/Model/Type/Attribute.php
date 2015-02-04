<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 17:46
 */

namespace Sphere\Core\Model\Type;

/**
 * Class Attribute
 * @package Sphere\Core\Model\Type
 * @method static Attribute of()
 */
class Attribute extends JsonObject
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var \JsonSerializable
     */
    protected $value;

    public function __construct($name, \JsonSerializable $value)
    {
        $this->setName($name);
        $this->setValue($value);
    }


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return \JsonSerializable
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param \JsonSerializable $value
     * @return $this
     */
    public function setValue(\JsonSerializable $value)
    {
        $this->value = $value;

        return $this;
    }
}
