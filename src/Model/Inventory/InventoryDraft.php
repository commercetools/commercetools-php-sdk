<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Inventory;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Channel\ChannelReference;

/**
 * @package Commercetools\Core\Model\Inventory
 * @method string getSku()
 * @method InventoryDraft setSku(string $sku = null)
 * @method int getQuantityOnStock()
 * @method InventoryDraft setQuantityOnStock(int $quantityOnStock = null)
 * @method int getRestockableInDays()
 * @method InventoryDraft setRestockableInDays(int $restockableInDays = null)
 * @method DateTimeDecorator getExpectedDelivery()
 * @method InventoryDraft setExpectedDelivery(\DateTime $expectedDelivery = null)
 * @method ChannelReference getSupplyChannel()
 * @method InventoryDraft setSupplyChannel(ChannelReference $supplyChannel = null)
 */
class InventoryDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'sku' => [static::TYPE => 'string'],
            'quantityOnStock' => [static::TYPE => 'int'],
            'restockableInDays' => [static::TYPE => 'int'],
            'expectedDelivery' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'supplyChannel' => [static::TYPE => '\Commercetools\Core\Model\Channel\ChannelReference'],
        ];
    }

    /**
     * @param string $sku
     * @param int $quantityOnStock
     * @param Context|callable $context
     * @return InventoryDraft
     */
    public static function ofSkuAndQuantityOnStock($sku, $quantityOnStock, $context = null)
    {
        return static::of($context)->setSku($sku)->setQuantityOnStock($quantityOnStock);
    }
}
