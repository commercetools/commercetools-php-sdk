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
 * @link https://dev.commercetools.com/http-api-projects-carts.html#set-customlineitem-taxrate
 * @method string getAction()
 * @method CartSetCustomLineItemTaxRateAction setAction(string $action = null)
 * @method string getCustomLineItemId()
 * @method CartSetCustomLineItemTaxRateAction setCustomLineItemId(string $customLineItemId = null)
 * @method ExternalTaxRateDraft getExternalTaxRate()
 * @method CartSetCustomLineItemTaxRateAction setExternalTaxRate(ExternalTaxRateDraft $externalTaxRate = null)
 */
class CartSetCustomLineItemTaxRateAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'customLineItemId' => [static::TYPE => 'string'],
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
        $this->setAction('setCustomLineItemTaxRate');
    }

    /**
     * @param $lineItemId
     * @param Context|callable $context
     * @return CartSetCustomLineItemTaxRateAction
     */
    public static function ofCustomLineItemId($lineItemId, $context = null)
    {
        return static::of($context)->setCustomLineItemId($lineItemId);
    }
}
