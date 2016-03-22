<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CartDiscounts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\CartDiscounts\Command
 * @link https://dev.commercetools.com/http-api-projects-cartDiscounts.html#change-sortOrder
 * @method string getAction()
 * @method CartDiscountChangeSortOrderAction setAction(string $action = null)
 * @method string getSortOrder()
 * @method CartDiscountChangeSortOrderAction setSortOrder(string $sortOrder = null)
 */
class CartDiscountChangeSortOrderAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'sortOrder' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeSortOrder');
    }

    /**
     * @param string $sortOrder
     * @param Context|callable $context
     * @return CartDiscountChangeSortOrderAction
     */
    public static function ofSortOrder($sortOrder, $context = null)
    {
        return static::of($context)->setSortOrder($sortOrder);
    }
}
