<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;

/**
 * @package Commercetools\Core\Model\Cart
 * @apidoc http://dev.sphere.io/http-api-projects-carts.html#create-cart
 * @method string getCurrency()
 * @method string getCustomerId()
 * @method string getCountry()
 * @method string getInventoryMode()
 * @method CartDraft setCurrency(string $currency = null)
 * @method CartDraft setCustomerId(string $customerId = null)
 * @method CartDraft setCountry(string $country = null)
 * @method CartDraft setInventoryMode(string $inventoryMode = null)
 * @method CustomFieldObjectDraft getCustom()
 * @method CartDraft setCustom(CustomFieldObjectDraft $custom = null)
 */
class CartDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'currency' => [static::TYPE => 'string'],
            'customerId' => [static::TYPE => 'string'],
            'country' => [static::TYPE => 'string'],
            'inventoryMode' => [static::TYPE => 'string'],
            'custom' => [static::TYPE => '\Commercetools\Core\Model\CustomField\CustomFieldObjectDraft'],
        ];
    }

    /**
     * @param string $currency
     * @param Context|callable $context
     * @return CartDraft
     */
    public static function ofCurrency($currency, $context = null)
    {
        $draft = static::of($context);
        return $draft->setCurrency($currency);
    }
}
