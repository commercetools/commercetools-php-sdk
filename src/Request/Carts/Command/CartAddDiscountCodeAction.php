<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts\Command;

use Sphere\Core\Request\AbstractAction;

/**
 * Class CartAddDiscountCodeAction
 * @package Sphere\Core\Request\Carts\Command
 * @method string getAction()
 * @method CartAddDiscountCodeAction setAction(string $action)
 * @method string getCode()
 * @method CartAddDiscountCodeAction setCode(string $code)
 */
class CartAddDiscountCodeAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'code' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param $code
     */
    public function __construct($code)
    {
        $this->setAction('addDiscountCode');
        $this->setCode($code);
    }
}
