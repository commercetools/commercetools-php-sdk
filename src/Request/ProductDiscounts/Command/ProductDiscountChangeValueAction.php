<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ProductDiscounts\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\ProductDiscount\ProductDiscountValue;
use Sphere\Core\Request\AbstractAction;

/**
 * Class ProductDiscountChangeValueAction
 * @package Sphere\Core\Request\ProductDiscounts\Command
 *  *
 * @method string getAction()
 * @method ProductDiscountChangeValueAction setAction(string $action = null)
 * @method ProductDiscountValue getValue()
 * @method ProductDiscountChangeValueAction setValue(ProductDiscountValue $value = null)
 */
class ProductDiscountChangeValueAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'value' => [static::TYPE => '\Sphere\Core\Model\ProductDiscount\ProductDiscountValue'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeValue');
    }

    /**
     * @param ProductDiscountValue $productDiscountValue
     * @param Context|callable $context
     * @return ProductDiscountChangeValueAction
     */
    public static function ofProductDiscountValue(ProductDiscountValue $productDiscountValue, $context = null)
    {
        return static::of($context)->setValue($productDiscountValue);
    }
}
