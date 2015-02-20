<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts\Command;


use Sphere\Core\Request\AbstractAction;

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
