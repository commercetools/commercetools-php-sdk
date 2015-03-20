<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Cart;

use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\OfTrait;

/**
 * Class CartDraft
 * @package Sphere\Core\Model\Cart
 * @method static CartDraft of(string $currency)
 * @method string getCurrency()
 * @method string getCustomerId()
 * @method string getCountry()
 * @method string getInventoryMode()
 * @method CartDraft setCurrency(string $currency = null)
 * @method CartDraft setCustomerId(string $customerId = null)
 * @method CartDraft setCountry(string $country = null)
 * @method CartDraft setInventoryMode(string $inventoryMode = null)
 */
class CartDraft extends JsonObject
{
    use OfTrait;

    public function getFields()
    {
        return [
            'currency' => [self::TYPE => 'string'],
            'customerId' => [self::TYPE => 'string'],
            'country' => [self::TYPE => 'string'],
            'inventoryMode' => [self::TYPE => 'string']
        ];
    }

    /**
     * @param string $currency
     */
    public function __construct($currency)
    {
        $this->setCurrency($currency);
    }
}
