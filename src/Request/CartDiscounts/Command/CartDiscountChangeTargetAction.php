<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CartDiscounts\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * @package Sphere\Core\Request\CartDiscounts\Command
 *  *
 * @method string getAction()
 * @method CartDiscountChangeTargetAction setAction(string $action = null)
 * @method string getTarget()
 * @method CartDiscountChangeTargetAction setTarget(string $target = null)
 */
class CartDiscountChangeTargetAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'target' => [static::TYPE => 'string'],
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
