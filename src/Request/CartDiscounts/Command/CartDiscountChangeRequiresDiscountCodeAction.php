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
 * @method CartDiscountChangeRequiresDiscountCodeAction setAction(string $action = null)
 * @method bool getRequiresDiscountCode()
 * @method CartDiscountChangeRequiresDiscountCodeAction setRequiresDiscountCode(bool $requiresDiscountCode = null)
 */
class CartDiscountChangeRequiresDiscountCodeAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'requiresDiscountCode' => [static::TYPE => 'bool'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeRequiresDiscountCode');
    }

    /**
     * @param bool $requiresDiscountCode
     * @param Context|callable $context
     * @return CartDiscountChangeRequiresDiscountCodeAction
     */
    public static function ofRequiresDiscountCode($requiresDiscountCode, $context = null)
    {
        return static::of($context)->setRequiresDiscountCode($requiresDiscountCode);
    }
}
