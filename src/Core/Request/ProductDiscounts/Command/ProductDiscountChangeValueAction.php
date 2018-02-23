<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductDiscounts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\ProductDiscount\ProductDiscountValue;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ProductDiscounts\Command
 * @link https://docs.commercetools.com/http-api-projects-productDiscounts.html#change-value
 * @method string getAction()
 * @method ProductDiscountChangeValueAction setAction(string $action = null)
 * @method ProductDiscountValue getValue()
 * @method ProductDiscountChangeValueAction setValue(ProductDiscountValue $value = null)
 */
class ProductDiscountChangeValueAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'value' => [static::TYPE => ProductDiscountValue::class],
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
