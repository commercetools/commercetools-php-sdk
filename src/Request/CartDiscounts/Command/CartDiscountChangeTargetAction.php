<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CartDiscounts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\CartDiscounts\Command
 * @link https://dev.commercetools.com/http-api-projects-cartDiscounts.html#change-target
 * @method string getAction()
 * @method CartDiscountChangeTargetAction setAction(string $action = null)
 * @method string getTarget()
 * @method CartDiscountChangeTargetAction setTarget(string $target = null)
 */
class CartDiscountChangeTargetAction extends AbstractAction
{
    public function fieldDefinitions()
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
