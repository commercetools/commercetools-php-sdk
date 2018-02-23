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
 * @codingStandardsIgnoreStart
 * @link https://docs.commercetools.com/http-api-projects-orders.html#change-the-state-of-customlineitem-according-to-allowed-transitions
 * @codingStandardsIgnoreEnd
 * @method string getAction()
 * @method OrderTransitionCustomLineItemStateAction setAction(string $action = null)
 * @method string getCustomLineItemId()
 * @method OrderTransitionCustomLineItemStateAction setCustomLineItemId(string $customLineItemId = null)
 * @method int getQuantity()
 * @method OrderTransitionCustomLineItemStateAction setQuantity(int $quantity = null)
 * @method StateReference getFromState()
 * @method OrderTransitionCustomLineItemStateAction setFromState(StateReference $fromState = null)
 * @method StateReference getToState()
 * @method OrderTransitionCustomLineItemStateAction setToState(StateReference $toState = null)
 * @method DateTimeDecorator getActualTransitionDate()
 * @method OrderTransitionCustomLineItemStateAction setActualTransitionDate(DateTime $actualTransitionDate = null)
 */
class OrderTransitionCustomLineItemStateAction extends AbstractAction
{
    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('transitionCustomLineItemState');
    }

    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'customLineItemId' => [static::TYPE => 'string'],
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
     * @param string $customLineItemId
     * @param int $quantity
     * @param StateReference $fromState
     * @param StateReference $toState
     * @param Context|callable $context
     * @return OrderTransitionCustomLineItemStateAction
     */
    public static function ofCustomLineItemIdQuantityAndFromToState(
        $customLineItemId,
        $quantity,
        StateReference $fromState,
        StateReference $toState,
        $context = null
    ) {
        return static::of($context)
            ->setCustomLineItemId($customLineItemId)
            ->setQuantity($quantity)
            ->setFromState($fromState)
            ->setToState($toState)
            ;
    }
}
