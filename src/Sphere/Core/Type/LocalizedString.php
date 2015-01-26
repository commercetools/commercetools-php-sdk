<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 15:19
 */

namespace Sphere\Core\Type;


use Sphere\Core\Error\Message;
use Sphere\Core\Error\InvalidArgumentException;

class LocalizedString
{
    protected $values = [];

    public function get($locale)
    {
        if (!isset($this->values[$locale])) {
            throw new InvalidArgumentException(Message::NO_VALUE_FOR_LOCALE);
        }
        return $this->values[$locale];
    }

    public function set($value, $locale)
    {
        $this->values[$locale] = $value;
    }
}
