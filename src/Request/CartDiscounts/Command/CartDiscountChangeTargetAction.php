<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CartDiscounts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\CartDiscount\CartDiscountTarget;

/**
 * @package Commercetools\Core\Request\CartDiscounts\Command
 * @link https://dev.commercetools.com/http-api-projects-cartDiscounts.html#change-target
 * @method string getAction()
 * @method CartDiscountChangeTargetAction setAction(string $action = null)
 * @method CartDiscountTarget getTarget()
 * @method CartDiscountChangeTargetAction setTarget(CartDiscountTarget $target = null)
 */
class CartDiscountChangeTargetAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'target' => [static::TYPE => 'Commercetools\Core\Model\CartDiscount\CartDiscountTarget'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeTarget');
    }

    /**
     * @param string $target
     * @param Context|callable $context
     * @return CartDiscountChangeTargetAction
     */
    public static function ofTarget($target, $context = null)
    {
        return static::of($context)->setTarget($target);
    }
}
