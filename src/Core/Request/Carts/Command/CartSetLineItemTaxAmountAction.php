<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Cart\ExternalTaxAmountDraft;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Carts\Command
 * @link https://docs.commercetools.com/http-api-projects-carts.html#set-lineitem-taxamount
 * @method string getAction()
 * @method CartSetLineItemTaxAmountAction setAction(string $action = null)
 * @method string getLineItemId()
 * @method CartSetLineItemTaxAmountAction setLineItemId(string $lineItemId = null)
 * @method ExternalTaxAmountDraft getExternalTaxAmount()
 * @method CartSetLineItemTaxAmountAction setExternalTaxAmount(ExternalTaxAmountDraft $externalTaxAmount = null)
 */
class CartSetLineItemTaxAmountAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'lineItemId' => [static::TYPE => 'string'],
            'externalTaxAmount' => [static::TYPE => ExternalTaxAmountDraft::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setLineItemTaxAmount');
    }
}
