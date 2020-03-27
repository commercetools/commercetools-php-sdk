<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\State\StateReference;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;

/**
 * @package Commercetools\Core\Request\Orders\Command
 * phpcs:disable
 * @link https://docs.commercetools.com/http-api-projects-orders.html#change-the-state-of-lineitem-according-to-allowed-transitions
 * phpcs:enable
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
 * @method OrderTransitionLineItemStateAction setActualTransitionDate(DateTime $actualTransitionDate = null)
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

    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'lineItemId' => [static::TYPE => 'string'],
            'quantity' => [static::TYPE => 'int'],
            'fromState' => [static::TYPE => StateReference::class],
            'toState' => [static::TYPE => StateReference::class],
            'actualTransitionDate' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
        ];
    }

    /**
     * @param string $lineItemId
     * @param int $quantity
     * @param StateReference $fromState
     * @param StateReference $toState
     * @param Context|callable $context
     * @return OrderTransitionLineItemStateAction
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
            ->setToState($toState);
    }
}
