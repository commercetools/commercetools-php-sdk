<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CartDiscounts\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * Class CartDiscountChangeIsActiveAction
 * @package Sphere\Core\Request\CartDiscounts\Command
 *  *
 * @method string getAction()
 * @method CartDiscountChangeIsActiveAction setAction(string $action = null)
 * @method bool getIsActive()
 * @method CartDiscountChangeIsActiveAction setIsActive(bool $isActive = null)
 */
class CartDiscountChangeIsActiveAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'isActive' => [static::TYPE => 'bool'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeIsActive');
    }

    /**
     * @param bool $isActive
     * @param Context|callable $context
     * @return CartDiscountChangeIsActiveAction
     */
    public static function ofIsActive($isActive, $context = null)
    {
        return static::of($context)->setIsActive($isActive);
    }
}
