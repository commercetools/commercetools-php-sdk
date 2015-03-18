<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts\Command;

use Sphere\Core\Model\DiscountCode\DiscountCodeReference;
use Sphere\Core\Request\AbstractAction;

/**
 * Class CartRemoveDiscountCodeAction
 * @package Sphere\Core\Request\Carts\Command
 * @method string getAction()
 * @method CartRemoveDiscountCodeAction setAction(string $action)
 * @method DiscountCodeReference getDiscountCode()
 * @method CartRemoveDiscountCodeAction setDiscountCode(DiscountCodeReference $discountCode)
 */
class CartRemoveDiscountCodeAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'discountCode' => [static::TYPE => '\Sphere\Core\Model\DiscountCode\DiscountCodeReference'],
        ];
    }

    /**
     * @param DiscountCodeReference $discountCode
     */
    public function __construct(DiscountCodeReference $discountCode)
    {
        $this->setAction('removeDiscountCode');
        $this->setDiscountCode($discountCode);
    }
}
