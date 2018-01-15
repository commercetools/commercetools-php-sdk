<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Cart
 * @link http://dev.commercetools.com/http-api-projects-carts.html#shippingrateinput
 * @method string getType()
 * @method ShippingRateInput setType(string $type = null)
 */
class ShippingRateInput extends JsonObject
{
    const INPUT_TYPE = '';

    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     * @return static
     */
    public static function fromArray(array $data, $context = null)
    {
        if (get_called_class() == ShippingRateInput::class && isset($data[static::INPUT_TYPE])) {
            $className = static::inputType($data[static::TYPE]);
            if (class_exists($className)) {
                return new $className($data, $context);
            }
        }
        return new static($data, $context);
    }

    protected static function inputType($type)
    {
        $types = [
            ClassificationShippingRateInput::INPUT_TYPE => ClassificationShippingRateInput::class,
            ScoreShippingRateInput::INPUT_TYPE => ScoreShippingRateInput::class,
        ];
        return isset($types[$type]) ? $types[$type] : ShippingRateInput::class;
    }

    /**
     * @param string $type
     * @param Context|callable $context
     * @return static
     */
    public static function ofType($type, $context = null)
    {
        $input = static::of($context);
        return $input->setType($type);
    }
}
