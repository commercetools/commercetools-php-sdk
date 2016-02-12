<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 * @link https://dev.commercetools.com/http-api-projects-products.html#product-variant-attribute
 * @link https://dev.commercetools.com/http-api-projects-productTypes.html#set-type
 * @link https://dev.commercetools.com/http-api-projects-productTypes.html#attribute-type
 */
class Set extends Collection implements TypeableInterface
{
    /**
     * @param $type
     * @param Context|callable $context
     * @return $this
     */
    public static function ofType($type, $context = null)
    {
        $set = static::of($context);
        return $set->setType($type);
    }

    /**
     * @param $type
     * @param array $data
     * @param Context|callable $context
     * @return $this
     */
    public static function ofTypeAndData($type, array $data, $context = null)
    {
        return static::ofType($type, $context)->setRawData($data);
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
