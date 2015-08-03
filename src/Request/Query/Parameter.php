<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Query;


use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Error\Message;

class Parameter implements ParameterInterface
{
    protected $key;
    protected $value;

    public function __construct($key, $value = null)
    {
        if (empty($key)) {
            throw new InvalidArgumentException(Message::NO_KEY_GIVEN);
        }
        $this->key = $key;
        $this->value = $value;
    }

    public function getId()
    {
        return $this->key;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function __toString()
    {
        $value = $this->getValue();
        if (is_null($value)) {
            $paramStr = $this->key;
        } elseif (is_bool($value)) {
            $paramStr = $this->key . '=' . ($value ? 'true' : 'false');
        } else {
            $paramStr = $this->key . '=' . urlencode((string)$value);
        }

        return $paramStr;
    }
}
