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
 * @link https://docs.commercetools.com/http-api-projects-carts.html#apply-deltatolineitemshippingdetailstargets
 * @method string getAction()
 * @method CartApplyDeltaToLineItemShippingDetailsTargetsAction setAction(string $action = null)
 * @method string getLineItemId()
 * @method CartApplyDeltaToLineItemShippingDetailsTargetsAction setLineItemId(string $lineItemId = null)
 * @method ItemShippingTargetCollection getTargetsDelta()
 * phpcs:disable
 * @method CartApplyDeltaToLineItemShippingDetailsTargetsAction setTargetsDelta(ItemShippingTargetCollection $targetsDelta = null)
 * phpcs:enable
 */
class CartApplyDeltaToLineItemShippingDetailsTargetsAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'lineItemId' => [static::TYPE => 'string'],
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
        $this->setAction('applyDeltaToLineItemShippingDetailsTargets');
    }
}
