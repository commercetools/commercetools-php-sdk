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
 * @method ShippingRateInputDraft setType(string $type = null)
 */
abstract class ShippingRateInputDraft extends JsonObject
{
    const INPUT_TYPE = '';

    /**
     * @inheritDoc
     */
    public function __construct(array $data = [], $context = null)
    {
        if (static::INPUT_TYPE != '' && !isset($data[static::TYPE])) {
            $data[static::TYPE] = static::INPUT_TYPE;
        }
        parent::__construct($data, $context);
    }

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
        if (get_called_class() == ShippingRateInput::class && isset($data[static::TYPE])) {
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
            ClassificationShippingRateInput::INPUT_TYPE => ClassificationShippingRateInputDraft::class,
            ScoreShippingRateInput::INPUT_TYPE => ScoreShippingRateInputDraft::class,
        ];
        return isset($types[$type]) ? $types[$type] : ShippingRateInputDraft::class;
    }

    /**
     * @param string $type
     * @param Context|callable $context
     * @return static
     */
    protected static function ofType($type, $context = null)
    {
        $input = static::of($context);
        return $input->setType($type);
    }
}
