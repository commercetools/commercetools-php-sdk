<?php

namespace Commercetools\Core\Request\Stores\Command;

use Commercetools\Core\Model\ProductSelection\ProductSelectionReference;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Stores\Command
 * @link https://docs.commercetools.com/api/projects/stores#remove-product-selection
 *
 * @method string getAction()
 * @method StoreRemoveProductSelectionAction setAction(string $action = null)
 * @method ProductSelectionReference getProductSelection()
 * @method StoreRemoveProductSelectionAction setProductSelection(ProductSelectionReference $productSelection = null)
 */
class StoreRemoveProductSelectionAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'productSelection' => [static::TYPE => ProductSelectionReference::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('removeProductSelection');
    }

    /**
     * @param ProductSelectionReference $productSelection
     * @param Context|callable $context
     * @return StoreRemoveProductSelectionAction
     */
    public static function ofProductSelection(ProductSelectionReference $productSelection, $context = null)
    {
        return static::of($context)->setProductSelection($productSelection);
    }
}
