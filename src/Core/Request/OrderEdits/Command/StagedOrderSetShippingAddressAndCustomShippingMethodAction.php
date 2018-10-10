<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\Command;

use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\ShippingMethod\ShippingRateDraft;
use Commercetools\Core\Model\TaxCategory\ExternalTaxRateDraft;
use Commercetools\Core\Model\TaxCategory\TaxCategoryReference;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\OrderEdits\Command
 *
 * @method string getAction()
 * @method StagedOrderSetShippingAddressAndCustomShippingMethodAction setAction(string $action = null)
 * @method Address getAddress()
 * @method StagedOrderSetShippingAddressAndCustomShippingMethodAction setAddress(Address $address = null)
 * @method string getShippingMethodName()
 * phpcs:disable
 * @method StagedOrderSetShippingAddressAndCustomShippingMethodAction setShippingMethodName(string $shippingMethodName = null)
 * phpcs:enable
 * @method ShippingRateDraft getShippingRate()
 * phpcs:disable
 * @method StagedOrderSetShippingAddressAndCustomShippingMethodAction setShippingRate(ShippingRateDraft $shippingRate = null)
 * phpcs:enable
 * @method TaxCategoryReference getTaxCategory()
 * phpcs:disable
 * @method StagedOrderSetShippingAddressAndCustomShippingMethodAction setTaxCategory(TaxCategoryReference $taxCategory = null)
 * phpcs:enable
 * @method ExternalTaxRateDraft getExternalTaxRate()
 * phpcs:disable
 * @method StagedOrderSetShippingAddressAndCustomShippingMethodAction setExternalTaxRate(ExternalTaxRateDraft $externalTaxRate = null)
 * phpcs:enable
 */
class StagedOrderSetShippingAddressAndCustomShippingMethodAction extends AbstractAction implements StagedOrderUpdateAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'address' => [static::TYPE => Address::class],
            'shippingMethodName' => [static::TYPE => 'string'],
            'shippingRate' => [static::TYPE => ShippingRateDraft::class],
            'taxCategory' => [static::TYPE => TaxCategoryReference::class],
            'externalTaxRate' => [static::TYPE => ExternalTaxRateDraft::class]
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setShippingAddressAndCustomShippingMethod');
    }
}
