<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\ShippingMethod\ShippingRateDraft;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\ShippingMethod\ShippingRate;
use Commercetools\Core\Model\TaxCategory\TaxCategoryReference;
use Commercetools\Core\Model\TaxCategory\ExternalTaxRateDraft;

/**
 * @package Commercetools\Core\Request\Carts\Command
 * @link https://docs.commercetools.com/http-api-projects-carts.html#set-custom-shippingmethod
 * @method string getAction()
 * @method CartSetCustomShippingMethodAction setAction(string $action = null)
 * @method string getShippingMethodName()
 * @method CartSetCustomShippingMethodAction setShippingMethodName(string $shippingMethodName = null)
 * @method ShippingRateDraft getShippingRate()
 * @method CartSetCustomShippingMethodAction setShippingRate(ShippingRateDraft $shippingRate = null)
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
            'shippingRate' => [static::TYPE => ShippingRateDraft::class],
            'taxCategory' => [static::TYPE => TaxCategoryReference::class],
            'externalTaxRate' => [static::TYPE => ExternalTaxRateDraft::class],
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
