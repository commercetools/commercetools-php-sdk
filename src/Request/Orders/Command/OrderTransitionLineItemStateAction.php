<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Orders\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\State\StateReference;
use Sphere\Core\Request\AbstractAction;
use Sphere\Core\Model\Common\DateTimeDecorator;

/**
 * @package Sphere\Core\Request\Orders\Command
 * @link http://dev.sphere.io/http-api-projects-orders.html#transition-line-item-state
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
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('transitionLineItemState');
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

    /**
     * @param string $lineItemId
     * @param int $quantity
     * @param StateReference $fromState
     * @param StateReference $toState
     * @param Context|callable $context
     * @return OrderTransitionCustomLineItemStateAction
     */
    public static function ofLineItemIdQuantityAndFromToState(
        $lineItemId,
        $quantity,
        StateReference $fromState,
        StateReference $toState,
        $context = null
    ) {
        return static::of($context)
            ->setLineItemId($lineItemId)
            ->setQuantity($quantity)
            ->setFromState($fromState)
            ->setToState($toState)
            ;
    }
}
