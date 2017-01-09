<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Inventory;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\CustomField\CustomFieldObject;

/**
 * @package Commercetools\Core\Model\Inventory
 * @link https://dev.commercetools.com/http-api-projects-inventory.html#inventoryentrydraft
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
 * @method CustomFieldObject getCustom()
 * @method InventoryDraft setCustom(CustomFieldObject $custom = null)
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
                static::DECORATOR => DateTimeDecorator::class
            ],
            'supplyChannel' => [static::TYPE => ChannelReference::class],
            'custom' => [static::TYPE => CustomFieldObject::class],
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
