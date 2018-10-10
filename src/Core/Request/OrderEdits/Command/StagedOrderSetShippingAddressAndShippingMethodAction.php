<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\Command;

use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodReference;
use Commercetools\Core\Model\TaxCategory\ExternalTaxRateDraft;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\OrderEdits\Command
 *
 * @method string getAction()
 * @method StagedOrderSetShippingAddressAndShippingMethodAction setAction(string $action = null)
 * @method Address getAddress()
 * @method StagedOrderSetShippingAddressAndShippingMethodAction setAddress(Address $address = null)
 * @method ShippingMethodReference getShippingMethod()
 * phpcs:disable
 * @method StagedOrderSetShippingAddressAndShippingMethodAction setShippingMethod(ShippingMethodReference $shippingMethod = null)
 * phpcs:enable
 * @method ExternalTaxRateDraft getExternalTaxRate()
 * phpcs:disable
 * @method StagedOrderSetShippingAddressAndShippingMethodAction setExternalTaxRate(ExternalTaxRateDraft $externalTaxRate = null)
 * phpcs:enable
 */
class StagedOrderSetShippingAddressAndShippingMethodAction extends AbstractAction implements StagedOrderUpdateAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'address' => [static::TYPE => Address::class],
            'shippingMethod' => [static::TYPE => ShippingMethodReference::class],
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
        $this->setAction('setShippingAddressAndShippingMethod');
    }
}
