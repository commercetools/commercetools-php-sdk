<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\DiscountCode\DiscountCodeReference;
use Sphere\Core\Request\AbstractAction;

/**
 * @package Sphere\Core\Request\Carts\Command
 * @link http://dev.sphere.io/http-api-projects-carts.html#remove-discount-code
 * @method string getAction()
 * @method CartRemoveDiscountCodeAction setAction(string $action = null)
 * @method DiscountCodeReference getDiscountCode()
 * @method CartRemoveDiscountCodeAction setDiscountCode(DiscountCodeReference $discountCode = null)
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
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('removeDiscountCode');
    }

    /**
     * @param DiscountCodeReference $discountCode
     * @param Context|callable $context
     */
    public static function ofDiscountCode(DiscountCodeReference $discountCode, $context = null)
    {
        return static::of($context)->setDiscountCode($discountCode);
    }
}
