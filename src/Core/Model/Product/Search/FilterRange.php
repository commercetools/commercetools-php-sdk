<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product\Search;

use Commercetools\Core\Model\Common\DateTimeDecorator;

/**
 * @package Commercetools\Core\Model\Product\Search
 */
class FilterRange
{
    /**
     * @var mixed
     */
    protected $from;

    /**
     * @var mixed
     */
    protected $to;

    /**
     * FilterRange constructor.
     * @param mixed $from
     * @param mixed $to
     */
    public function __construct($from = null, $to = null)
    {
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * @param $value
     * @return string
     */
    protected function valueToString($value)
    {
        if (is_null($value)) {
            return '*';
        }
        if (is_int($value)) {
            return (string)$value;
        }
        if (is_float($value)) {
            return (string)$value;
        }
        if (is_string($value)) {
            return '"' . $value . '"';
        }
        if ($value instanceof \DateTime) {
            $decorator = new DateTimeDecorator($value);
            return '"' . $decorator->jsonSerialize() . '"';
        }
        return (string)$value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf('(%s to %s)', $this->valueToString($this->getFrom()), $this->valueToString($this->getTo()));
    }

    /**
     * @return static
     */
    public static function of()
    {
        return new static();
    }

    /**
     * @param $from
     * @return static
     */
    public static function ofFrom($from)
    {
        return new static($from);
    }

    /**
     * @param $to
     * @return static
     */
    public static function ofTo($to)
    {
        return new static(null, $to);
    }

    /**
     * @param $from
     * @param $to
     * @return static
     */
    public static function ofFromAndTo($from, $to)
    {
        return new static($from, $to);
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param $from
     * @return $this
     */
    public function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param mixed $to
     * @return $this
     */
    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }
}
