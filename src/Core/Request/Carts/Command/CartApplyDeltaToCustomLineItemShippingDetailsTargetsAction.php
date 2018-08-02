<?php
/**
 *
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Cart\ItemShippingTargetCollection;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Carts\Command
 * @link https://docs.commercetools.com/http-api-projects-carts.html#apply-deltatocustomlineitemshippingdetailstargets
 * @method string getAction()
 * @method CartApplyDeltaToCustomLineItemShippingDetailsTargetsAction setAction(string $action = null)
 * @method string getLineItemId()
 * @method CartApplyDeltaToLineItemShippingDetailsTargetsAction setLineItemId(string $lineItemId = null)
 * @method ItemShippingTargetCollection getTargetsDelta()
 * @codingStandardsIgnoreStart
 * @method CartApplyDeltaToCustomLineItemShippingDetailsTargetsAction setTargetsDelta(ItemShippingTargetCollection $targetsDelta = null)
 * @codingStandardsIgnoreEnd
 * @method string getCustomLineItemId()
 * @codingStandardsIgnoreStart
 * @method CartApplyDeltaToCustomLineItemShippingDetailsTargetsAction setCustomLineItemId(string $customLineItemId = null)
 * @codingStandardsIgnoreEnd
 */
class CartApplyDeltaToCustomLineItemShippingDetailsTargetsAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'customLineItemId' => [static::TYPE => 'string'],
            'targetsDelta' => [static::TYPE => ItemShippingTargetCollection::class]
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], Context $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('applyDeltaToCustomLineItemShippingDetailsTargets');
    }
}
