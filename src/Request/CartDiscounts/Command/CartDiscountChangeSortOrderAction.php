<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CartDiscounts\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * Class CartDiscountChangeSortOrderAction
 * @package Sphere\Core\Request\CartDiscounts\Command
 *  *
 * @method string getAction()
 * @method CartDiscountChangeSortOrderAction setAction(string $action = null)
 * @method string getSortOrder()
 * @method CartDiscountChangeSortOrderAction setSortOrder(string $sortOrder = null)
 */
class CartDiscountChangeSortOrderAction extends AbstractAction
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
     * @return CartDiscountChangeSortOrderAction
     */
    public static function ofSortOrder($sortOrder, $context = null)
    {
        return static::of($context)->setSortOrder($sortOrder);
    }
}
