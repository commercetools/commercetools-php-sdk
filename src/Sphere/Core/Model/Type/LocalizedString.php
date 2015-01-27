<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 15:19
 */

namespace Sphere\Core\Model\Type;


use Sphere\Core\Error\Message;
use Sphere\Core\Error\InvalidArgumentException;

/**
 * Class LocalizedString
 * @package Sphere\Core\Model\Type
 * @example LocalizedString::of(['en' => 'Hello World', 'de' => 'Hallo Welt'])->add('fr', 'Bonjour le monde');
 */
class LocalizedString implements \JsonSerializable
{
    protected $values = [];

    /**
     * @param array $values
     */
    public function __construct(array $values)
    {
        $this->values = $values;
    }


    public function get($locale)
    {
        if (!isset($this->values[$locale])) {
            throw new InvalidArgumentException(Message::NO_VALUE_FOR_LOCALE);
        }
        return $this->values[$locale];
    }

    public function add($locale, $value)
    {
        $this->values[$locale] = $value;

        return $this;
    }

    public function jsonSerialize()
    {
        return $this->values;
    }

    public static function of(array $values)
    {
        return new static($values);
    }
}
