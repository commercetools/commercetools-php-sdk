<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CartDiscounts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\CartDiscounts\Command
 * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#change-name
 * @method string getAction()
 * @method CartDiscountChangeNameAction setAction(string $action = null)
 * @method LocalizedString getName()
 * @method CartDiscountChangeNameAction setName(LocalizedString $name = null)
 */
class CartDiscountChangeNameAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'name' => [static::TYPE => LocalizedString::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeName');
    }

    /**
     * @param LocalizedString $name
     * @param Context|callable $context
     * @return CartDiscountChangeNameAction
     */
    public static function ofName(LocalizedString $name, $context = null)
    {
        return static::of($context)->setName($name);
    }
}
