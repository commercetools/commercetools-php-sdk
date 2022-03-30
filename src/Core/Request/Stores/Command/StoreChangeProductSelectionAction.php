<?php

namespace Commercetools\Core\Request\Stores\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\ProductSelection\ProductSelectionReference;
use Commercetools\Core\Model\Store\ProductSelectionSetting;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Stores\Command
 *
 * @method string getAction()
 * @method StoreChangeProductSelectionAction setAction(string $action = null)
 * @method ProductSelectionReference getProductSelection()
 * @method StoreChangeProductSelectionAction setProductSelection(ProductSelectionReference $productSelection = null)
 * @method bool getActive()
 * @method StoreChangeProductSelectionAction setActive(bool $active = null)
 */
class StoreChangeProductSelectionAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'productSelection' => [static::TYPE => ProductSelectionReference::class],
            'active' => [static::TYPE => 'bool', static::OPTIONAL => 'true'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeProductSelection');
    }

    /**
     * @param ProductSelectionSetting $productSelectionSetting
     * @param Context|callable $context
     * @return StoreChangeProductSelectionAction
     */
    public static function ofProductSelection(ProductSelectionSetting $productSelectionSetting, $context = null)
    {
        return static::of($context)->setProductSelection($productSelectionSetting);
    }
}
