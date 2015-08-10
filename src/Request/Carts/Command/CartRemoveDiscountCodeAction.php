<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\DiscountCode\DiscountCodeReference;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Carts\Command
 * @apidoc http://dev.sphere.io/http-api-projects-carts.html#remove-discount-code
 * @method string getAction()
 * @method CartRemoveDiscountCodeAction setAction(string $action = null)
 * @method DiscountCodeReference getDiscountCode()
 * @method CartRemoveDiscountCodeAction setDiscountCode(DiscountCodeReference $discountCode = null)
 */
class CartRemoveDiscountCodeAction extends AbstractAction
{
    public function getPropertyDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'discountCode' => [static::TYPE => '\Commercetools\Core\Model\DiscountCode\DiscountCodeReference'],
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
