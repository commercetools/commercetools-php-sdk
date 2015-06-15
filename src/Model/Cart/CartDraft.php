<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Cart;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\OfTrait;

/**
 * Class CartDraft
 * @package Sphere\Core\Model\Cart
 * @link http://dev.sphere.io/http-api-projects-carts.html#create-cart
 * @method static CartDraft of($currency)
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
     * @param Context|callable $context
     */
    public function __construct($currency, $context = null)
    {
        $this->setContext($context)
            ->setCurrency($currency);
    }
}
