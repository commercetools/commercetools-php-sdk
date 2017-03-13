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
 * @link https://dev.commercetools.com/http-api-projects-carts.html#set-lineitem-taxrate
 * @method string getAction()
 * @method CartSetLineItemTaxRateAction setAction(string $action = null)
 * @method string getLineItemId()
 * @method CartSetLineItemTaxRateAction setLineItemId(string $lineItemId = null)
 * @method ExternalTaxRateDraft getExternalTaxRate()
 * @method CartSetLineItemTaxRateAction setExternalTaxRate(ExternalTaxRateDraft $externalTaxRate = null)
 */
class CartSetLineItemTaxRateAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'lineItemId' => [static::TYPE => 'string'],
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
        $this->setAction('setLineItemTaxRate');
    }

    /**
     * @param $lineItemId
     * @param Context|callable $context
     * @return CartSetLineItemTaxRateAction
     */
    public static function ofLineItemId($lineItemId, $context = null)
    {
        return static::of($context)->setLineItemId($lineItemId);
    }
}
