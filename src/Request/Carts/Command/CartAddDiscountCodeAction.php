<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Carts\Command
 * @apidoc http://dev.sphere.io/http-api-projects-carts.html#add-discount-code
 * @method string getAction()
 * @method CartAddDiscountCodeAction setAction(string $action = null)
 * @method string getCode()
 * @method CartAddDiscountCodeAction setCode(string $code = null)
 */
class CartAddDiscountCodeAction extends AbstractAction
{
    public function getPropertyDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'code' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('addDiscountCode');
    }

    /**
     * @param string $code
     * @param Context|callable $context
     * @return CartAddDiscountCodeAction
     */
    public static function ofCode($code, $context = null)
    {
        return static::of($context)->setCode($code);
    }
}
