<?php
/**
 */

namespace Commercetools\Core\Request\CartDiscounts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\CartDiscounts\Command
 *
 * @method string getAction()
 * @method CartDiscountSetKeyAction setAction(string $action = null)
 * @method string getKey()
 * @method CartDiscountSetKeyAction setKey(string $key = null)
 */
class CartDiscountSetKeyAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'key' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setKey');
    }

    /**
     * @param string $key
     * @param Context|callable $context
     * @return CartDiscountSetKeyAction
     */
    public static function ofKey($key, $context = null)
    {
        return static::of($context)->setKey($key);
    }
}
