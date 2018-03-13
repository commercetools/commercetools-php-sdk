<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductDiscounts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ProductDiscounts\Command
 * @link https://docs.commercetools.com/http-api-projects-productDiscounts.html#change-sort-order
 * @method string getAction()
 * @method ProductDiscountChangeSortOrderAction setAction(string $action = null)
 * @method string getSortOrder()
 * @method ProductDiscountChangeSortOrderAction setSortOrder(string $sortOrder = null)
 */
class ProductDiscountChangeSortOrderAction extends AbstractAction
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
     * @return ProductDiscountChangeSortOrderAction
     */
    public static function ofSortOrder($sortOrder, $context = null)
    {
        return static::of($context)->setSortOrder($sortOrder);
    }
}
