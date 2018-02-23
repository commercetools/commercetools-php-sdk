<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CartDiscount;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\CartDiscount
 * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#cartdiscounttarget
 * @method string getType()
 * @method CartDiscountTarget setType(string $type = null)
 * @method string getPredicate()
 * @method CartDiscountTarget setPredicate(string $predicate = null)
 */
class CartDiscountTarget extends JsonObject
{
    const TARGET_TYPE = '';
    const TYPE_LINE_ITEMS = 'lineItems';

    /**
     * @inheritDoc
     */
    public function __construct(array $data = [], $context = null)
    {
        if (static::TARGET_TYPE != '' && !isset($data[static::TYPE])) {
            $data[static::TYPE] = static::TARGET_TYPE;
        }
        parent::__construct($data, $context);
    }


    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string'],
            'predicate' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @inheritDoc
     */
    public static function fromArray(array $data, $context = null)
    {
        if (get_called_class() === CartDiscountTarget::class && isset($data[static::TYPE])) {
            $className = static::targetType($data[static::TYPE]);
            if (class_exists($className)) {
                return new $className($data, $context);
            }
        }
        return new static($data, $context);
    }

    protected static function targetType($typeId)
    {
        $types = [
            LineItemsTarget::TARGET_TYPE => LineItemsTarget::class,
            CustomLineItemsTarget::TARGET_TYPE => CustomLineItemsTarget::class,
            ShippingCostTarget::TARGET_TYPE => ShippingCostTarget::class,
            MultiBuyLineItemsTarget::TARGET_TYPE => MultiBuyLineItemsTarget::class,
        ];
        return isset($types[$typeId]) ? $types[$typeId] : CartDiscountTarget::class;
    }
}
