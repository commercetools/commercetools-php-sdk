<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts\Command;

use Sphere\Core\Request\AbstractAction;

/**
 * Class CartAddDiscountCodeAction
 * @package Sphere\Core\Request\Carts\Command
 * @link http://dev.sphere.io/http-api-projects-carts.html#add-discount-code
 * @method string getAction()
 * @method CartAddDiscountCodeAction setAction(string $action = null)
 * @method string getCode()
 * @method CartAddDiscountCodeAction setCode(string $code = null)
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
