<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;

/**
 * Class Set
 * @package Sphere\Core\Model\Common
 * @link http://dev.sphere.io/http-api-projects-products.html#product-variant-attribute
 */
class Set extends Collection
{
    /**
     * @param string $type
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct($type, array $data = [], $context = null)
    {
        $this->type = $type;
        $this->setContext($context);
        $this->rawData = $data;
        $this->indexData();
    }

    /**
     * @param array $data
     * @param Context|callable $context
     * @return static
     */
    public static function fromArray(array $data, $context = null)
    {
        $type = $data['type'];
        $setData = $data['value'];
        return new static($type, $setData, $context);
    }

    public function __toString()
    {
        $values = [];
        foreach ($this as $set) {
            $values[] = (string)$set;
        }
        return implode(', ', $values);
    }
}
