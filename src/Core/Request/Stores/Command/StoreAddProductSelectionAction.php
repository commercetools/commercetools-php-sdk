<?php

namespace Commercetools\Core\Request\Stores\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Store\ProductSelectionSetting;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Stores\Command
 *
 * @method string getAction()
 * @method StoreAddProductSelectionAction setAction(string $action = null)
 * @method ProductSelectionSetting getProductSelection()
 * @method StoreAddProductSelectionAction setProductSelection(ProductSelectionSetting $productSelection = null)
 */
class StoreAddProductSelectionAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'productSelection' => [static::TYPE => ProductSelectionSetting::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('addProductSelection');
    }

    /**
     * @param ProductSelectionSetting $productSelectionSetting
     * @param Context|callable $context
     * @return StoreAddProductSelectionAction
     */
    public static function ofProductSelection(ProductSelectionSetting $productSelectionSetting, $context = null)
    {
        return static::of($context)->setProductSelection($productSelectionSetting);
    }
}
