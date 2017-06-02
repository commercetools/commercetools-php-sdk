<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product\Search;

class FilterSubtree
{
    /**
     * @var mixed
     */
    protected $id;

    /**
     * FilterRange constructor.
     * @param mixed $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @param $value
     * @return string
     */
    protected function valueToString($value)
    {
        $value = (string)$value;
        return '"' . (string)$value . '"';
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf('subtree(%s)', $this->valueToString($this->getId()));
    }

    /**
     * @param $id
     * @return static
     */
    public static function ofId($id)
    {
        return new static($id);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
}
