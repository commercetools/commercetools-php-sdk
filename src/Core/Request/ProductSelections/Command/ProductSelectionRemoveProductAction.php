<?php

namespace Commercetools\Core\Request\ProductSelections\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Product\ProductReference;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ProductSelections\Command
 *
 * @method string getAction()
 * @method ProductSelectionRemoveProductAction setAction(string $action = null)
 * @method ProductReference getProduct()
 * @method ProductSelectionRemoveProductAction setProduct(ProductReference $product = null)
 */
class ProductSelectionRemoveProductAction extends AbstractAction
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
        $this->setAction('removeProduct');
    }

    /**
     * @param ProductReference $product
     * @param Context|callable $context
     * @return ProductSelectionRemoveProductAction
     */
    public static function ofProduct($product, $context = null)
    {
        return static::of($context)->setProduct($product);
    }
}
