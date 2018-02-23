<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CartDiscounts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\CartDiscounts\Command
 * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#change-requires-discountcode
 * @method string getAction()
 * @method CartDiscountChangeRequiresDiscountCodeAction setAction(string $action = null)
 * @method bool getRequiresDiscountCode()
 * @method CartDiscountChangeRequiresDiscountCodeAction setRequiresDiscountCode(bool $requiresDiscountCode = null)
 */
class CartDiscountChangeRequiresDiscountCodeAction extends AbstractAction
{
    public function fieldDefinitions()
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
