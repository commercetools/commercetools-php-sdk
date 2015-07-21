<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Order;

use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Model\Common\Price;
use Sphere\Core\Model\Channel\ChannelReference;
use Sphere\Core\Model\TaxCategory\TaxRate;

/**
 * @package Sphere\Core\Model\Order
 * @method string getProductId()
 * @method ImportLineItem setProductId(string $productId = null)
 * @method LocalizedString getName()
 * @method ImportLineItem setName(LocalizedString $name = null)
 * @method ImportProductVariant getVariant()
 * @method ImportLineItem setVariant(ImportProductVariant $variant = null)
 * @method Price getPrice()
 * @method ImportLineItem setPrice(Price $price = null)
 * @method int getQuantity()
 * @method ImportLineItem setQuantity(int $quantity = null)
 * @method ItemStateCollection getState()
 * @method ImportLineItem setState(ItemStateCollection $state = null)
 * @method ChannelReference getSupplyChannel()
 * @method ImportLineItem setSupplyChannel(ChannelReference $supplyChannel = null)
 * @method TaxRate getTaxRate()
 * @method ImportLineItem setTaxRate(TaxRate $taxRate = null)
 */
class ImportLineItem extends JsonObject
{
    public function getFields()
    {
        return [
            'productId' => [static::TYPE => 'string'],
            'name' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'variant' => [static::TYPE => '\Sphere\Core\Model\Order\ImportProductVariant'],
            'price' => [static::TYPE => '\Sphere\Core\Model\Common\Price'],
            'quantity' => [static::TYPE => 'int'],
            'state' => [static::TYPE => '\Sphere\Core\Model\Order\ItemStateCollection'],
            'supplyChannel' => [static::TYPE => '\Sphere\Core\Model\Channel\ChannelReference'],
            'taxRate' => [static::TYPE => '\Sphere\Core\Model\TaxCategory\TaxRate'],
        ];
    }
}
