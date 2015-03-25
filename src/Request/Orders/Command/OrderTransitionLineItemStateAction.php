<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Orders\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\State\StateReference;
use Sphere\Core\Request\AbstractAction;
use \Sphere\Core\Model\Common\DateTimeDecorator;

/**
 * Class OrderTransitionLineItemStateAction
 * @package Sphere\Core\Request\Orders\Command
 * @method string getAction()
 * @method OrderTransitionLineItemStateAction setAction(string $action = null)
 * @method string getLineItemId()
 * @method OrderTransitionLineItemStateAction setLineItemId(string $lineItemId = null)
 * @method int getQuantity()
 * @method OrderTransitionLineItemStateAction setQuantity(int $quantity = null)
 * @method StateReference getFromState()
 * @method OrderTransitionLineItemStateAction setFromState(StateReference $fromState = null)
 * @method StateReference getToState()
 * @method OrderTransitionLineItemStateAction setToState(StateReference $toState = null)
 * @method DateTimeDecorator getActualTransitionDate()
 * @method OrderTransitionLineItemStateAction setActualTransitionDate(\DateTime $actualTransitionDate = null)
 */
class OrderTransitionLineItemStateAction extends AbstractAction
{
    /**
     * @param string $lineItemId
     * @param int $quantity
     * @param StateReference $fromState
     * @param StateReference $toState
     * @param Context $context
     */
    public function __construct(
        $lineItemId,
        $quantity,
        StateReference $fromState,
        StateReference $toState,
        Context $context = null
    ) {
        $this->setContext($context)
            ->setAction('transitionLineItemState')
            ->setLineItemId($lineItemId)
            ->setQuantity($quantity)
            ->setFromState($fromState)
            ->setToState($toState)
        ;
    }

    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'lineItemId' => [static::TYPE => 'string'],
            'quantity' => [static::TYPE => 'int'],
            'fromState' => [static::TYPE => '\Sphere\Core\Model\State\StateReference'],
            'toState' => [static::TYPE => '\Sphere\Core\Model\State\StateReference'],
            'actualTransitionDate' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Sphere\Core\Model\Common\DateTimeDecorator'
            ],
        ];
    }
}
