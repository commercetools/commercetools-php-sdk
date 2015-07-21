<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ProductDiscounts\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * @package Sphere\Core\Request\ProductDiscounts\Command
 *  *
 * @method string getAction()
 * @method ProductDiscountChangeSortOrderAction setAction(string $action = null)
 * @method string getSortOrder()
 * @method ProductDiscountChangeSortOrderAction setSortOrder(string $sortOrder = null)
 */
class ProductDiscountChangeSortOrderAction extends AbstractAction
{
    public function getFields()
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
