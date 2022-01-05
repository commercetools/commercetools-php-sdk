<?php

namespace Commercetools\Core\Request\ProductSelections\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Product\ProductReference;
use Commercetools\Core\Model\ProductSelection\ProductSelectionReference;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ProductSelections\Command
 * @method string getAction()
 * @method ProductSelectionAddProductAction setAction(string $action = null)
 * @method ProductReference getProduct()
 * @method ProductSelectionAddProductAction setProduct(ProductReference $product = null)
 */
class ProductSelectionAddProductAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'product' => [static::TYPE => ProductReference::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('addProduct');
    }

    /**
     * @param ProductReference $product
     * @param Context|callable $context
     * @return ProductSelectionAddProductAction
     */
    public static function ofProduct($product, $context = null)
    {
        return static::of($context)->setProduct($product);
    }
}
