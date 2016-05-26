<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\TaxCategory\ExternalTaxRateDraft;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Carts\Command
 * @link http://dev.commercetools.com/http-api-projects-carts.html#set-shippingmethod-taxrate
 * @method string getAction()
 * @method CartSetShippingMethodTaxRateAction setAction(string $action = null)
 * @method ExternalTaxRateDraft getExternalTaxRate()
 * @method CartSetShippingMethodTaxRateAction setExternalTaxRate(ExternalTaxRateDraft $externalTaxRate = null)
 */
class CartSetShippingMethodTaxRateAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
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
        $this->setAction('setShippingMethodTaxRate');
    }
}
