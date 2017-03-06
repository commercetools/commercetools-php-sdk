<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShoppingLists\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use DateTime;

/**
 * @package Commercetools\Core\Request\ShoppingLists\Command
 * @link https://dev.commercetools.com/http-api-projects-shoppingLists.html#add-lineitem
 * @method string getAction()
 * @method ShoppingListAddLineItemAction setAction(string $action = null)
 * @method string getProductId()
 * @method ShoppingListAddLineItemAction setProductId(string $productId = null)
 * @method int getVariantId()
 * @method ShoppingListAddLineItemAction setVariantId(int $variantId = null)
 * @method int getQuantity()
 * @method ShoppingListAddLineItemAction setQuantity(int $quantity = null)
 * @method CustomFieldObjectDraft getCustom()
 * @method ShoppingListAddLineItemAction setCustom(CustomFieldObjectDraft $custom = null)
 * @method DateTimeDecorator getAddedAt()
 * @method ShoppingListAddLineItemAction setAddedAt(DateTime $addedAt = null)
 */
class ShoppingListAddLineItemAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'productId' => [static::TYPE => 'string'],
            'variantId' => [static::TYPE => 'int'],
            'quantity' => [static::TYPE => 'int'],
            'addedAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'custom' => [static::TYPE => CustomFieldObjectDraft::class],
        ];
    }

    /**
     * @param string $productId
     * @param int $variantId
     * @param Context|callable $context
     * @param int $quantity
     * @return ShoppingListAddLineItemAction
     */
    public static function ofProductIdVariantIdAndQuantity($productId, $variantId, $quantity, $context = null)
    {
        return static::of($context)->setProductId($productId)->setVariantId($variantId)->setQuantity($quantity);
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('addLineItem');
    }
}
