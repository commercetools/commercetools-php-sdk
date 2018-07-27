<?php
/**
 *
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Cart
 *
 * @method string getAddressKey()
 * @method ItemShippingTarget setAddressKey(string $addressKey = null)
 * @method int getQuantity()
 * @method ItemShippingTarget setQuantity(int $quantity = null)
 */
class ItemShippingTarget extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'addressKey' => [static::TYPE => 'string'],
            'quantity' => [static::TYPE => 'int'],
        ];
    }
}
