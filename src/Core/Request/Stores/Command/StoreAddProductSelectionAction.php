<?php

namespace Commercetools\Core\Request\Stores\Command;

use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Store\ProductSelectionSettingDraft;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Stores\Command
 * @link https://docs.commercetools.com/api/projects/stores#add-distribution-channel
 * @method string getAction()
 * @method StoreAddProductSelectionAction setAction(string $action = null)
 * @method ChannelReference getDistributionChannel()
 * @method StoreAddProductSelectionAction setDistributionChannel(ChannelReference $productSelectionSettingDraft = null)
 * @method ProductSelectionSettingDraft getProductSelection()
 * @method StoreAddProductSelectionAction setProductSelection(ProductSelectionSettingDraft $productSelection = null)
 */
class StoreAddProductSelectionAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'productSelection' => [static::TYPE => ProductSelectionSettingDraft::class],
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
     * @param ProductSelectionSettingDraft $productSelectionSettingDraft
     * @param Context|callable $context
     * @return StoreAddProductSelectionAction
     */
    public static function ofProductSelection(ProductSelectionSettingDraft $productSelectionSettingDraft, $context = null)
    {
        return static::of($context)->setProductSelection($productSelectionSettingDraft);
    }
}
