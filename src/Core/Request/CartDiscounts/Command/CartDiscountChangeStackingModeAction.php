<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CartDiscounts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\CartDiscounts\Command
 * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#change-stacking-mode
 * @method string getAction()
 * @method CartDiscountChangeStackingModeAction setAction(string $action = null)
 * @method CartDiscountChangeStackingModeAction setStackingMode(string $stackingMode = null)
 * @method string getStackingMode()
 */
class CartDiscountChangeStackingModeAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'stackingMode' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeStackingMode');
    }

    /**
     * @param string $stackingMode
     * @param Context|callable $context
     * @return CartDiscountChangeStackingModeAction
     */
    public static function ofStackingMode($stackingMode, $context = null)
    {
        return static::of($context)->setStackingMode($stackingMode);
    }
}
