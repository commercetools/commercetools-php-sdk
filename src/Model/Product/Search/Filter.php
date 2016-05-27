<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product\Search;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Product\Search
 */
class Filter implements FilterInterface
{
    /**
     * @var mixed
     */
    protected $name;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var mixed
     */
    protected $alias;

    /**
     * Filter constructor.
     * @param string $name
     * @param mixed $value
     * @param mixed $alias
     */
    public function __construct($name, $value = null, $alias = null)
    {
        $this->name = $name;
        $this->value = $value;
        $this->alias = $alias;
    }

    /**
     * @param string $name
     * @return static
     */
    public static function ofName($name)
    {
        $filter = new static($name);

        return $filter;
    }

    /**
     * @param $value
     * @return string
     */
    protected function valueToString($value)
    {
        if (is_int($value)) {
            return $value;
        }
        if (is_float($value)) {
            return $value;
        }
        if (is_bool($value)) {
            return $value ? 'true': 'false';
        }
        if (is_string($value)) {
            return '"' . $value . '"';
        }
        if (is_array($value)) {
            $values = array_map([$this, 'valueToString'], $value);
            return implode(",", $values);
        }
        return (string)$value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $facet = $this->getName();
        $value = $this->getValue();
        $alias = $this->getAlias();
        if (!is_null($value)) {
            $facet .= ':' . $this->valueToString($value);
        }
        if ($alias) {
            $facet .= ' as ' . $alias;
        }

        return $facet;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param mixed $alias
     * @return $this
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }
}
