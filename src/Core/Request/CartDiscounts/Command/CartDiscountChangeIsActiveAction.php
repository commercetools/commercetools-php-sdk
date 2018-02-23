<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CartDiscounts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\CartDiscounts\Command
 * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#change-isactive
 * @method string getAction()
 * @method CartDiscountChangeIsActiveAction setAction(string $action = null)
 * @method bool getIsActive()
 * @method CartDiscountChangeIsActiveAction setIsActive(bool $isActive = null)
 */
class CartDiscountChangeIsActiveAction extends AbstractAction
{
    public function fieldDefinitions()
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
