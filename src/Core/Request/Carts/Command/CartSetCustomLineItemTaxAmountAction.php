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
 * @link https://docs.commercetools.com/http-api-projects-carts.html#set-customlineitem-taxamount
 * @method string getAction()
 * @method CartSetCustomLineItemTaxAmountAction setAction(string $action = null)
 * @method string getCustomLineItemId()
 * @method CartSetCustomLineItemTaxAmountAction setCustomLineItemId(string $customLineItemId = null)
 * @method ExternalTaxAmountDraft getExternalTaxAmount()
 * @method CartSetCustomLineItemTaxAmountAction setExternalTaxAmount(ExternalTaxAmountDraft $externalTaxAmount = null)
 */
class CartSetCustomLineItemTaxAmountAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'customLineItemId' => [static::TYPE => 'string'],
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
        $this->setAction('setCustomLineItemTaxAmount');
    }
}
