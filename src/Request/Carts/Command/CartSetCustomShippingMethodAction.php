<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\ShippingMethod\ShippingRate;
use Commercetools\Core\Model\TaxCategory\TaxCategoryReference;
use Commercetools\Core\Model\TaxCategory\ExternalTaxRateDraft;

/**
 * @package Commercetools\Core\Request\Carts\Command
 * @link https://dev.commercetools.com/http-api-projects-carts.html#set-custom-shipping-method
 * @method string getAction()
 * @method CartSetCustomShippingMethodAction setAction(string $action = null)
 * @method string getShippingMethodName()
 * @method CartSetCustomShippingMethodAction setShippingMethodName(string $shippingMethodName = null)
 * @method ShippingRate getShippingRate()
 * @method CartSetCustomShippingMethodAction setShippingRate(ShippingRate $shippingRate = null)
 * @method TaxCategoryReference getTaxCategory()
 * @method CartSetCustomShippingMethodAction setTaxCategory(TaxCategoryReference $taxCategory = null)
 * @method ExternalTaxRateDraft getExternalTaxRate()
 * @method CartSetCustomShippingMethodAction setExternalTaxRate(ExternalTaxRateDraft $externalTaxRate = null)
 */
class CartSetCustomShippingMethodAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'shippingMethodName' => [static::TYPE => 'string'],
            'shippingRate' => [static::TYPE => '\Commercetools\Core\Model\ShippingMethod\ShippingRate'],
            'taxCategory' => [static::TYPE => '\Commercetools\Core\Model\TaxCategory\TaxCategoryReference'],
            'externalTaxRate' => [static::TYPE => '\Commercetools\Core\Model\TaxCategory\ExternalTaxRateDraft'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setCustomShippingMethod');
    }
}
