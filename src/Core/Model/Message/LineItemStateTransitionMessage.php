<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\State\StateReference;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-projects-messages.html#lineitemstatetransition-message
 * @method string getId()
 * @method LineItemStateTransitionMessage setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method LineItemStateTransitionMessage setCreatedAt(DateTime $createdAt = null)
 * @method int getSequenceNumber()
 * @method LineItemStateTransitionMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method LineItemStateTransitionMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method LineItemStateTransitionMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method LineItemStateTransitionMessage setType(string $type = null)
 * @method string getLineItemId()
 * @method LineItemStateTransitionMessage setLineItemId(string $lineItemId = null)
 * @method DateTimeDecorator getTransitionDate()
 * @method LineItemStateTransitionMessage setTransitionDate(DateTime $transitionDate = null)
 * @method int getQuantity()
 * @method LineItemStateTransitionMessage setQuantity(int $quantity = null)
 * @method StateReference getFromState()
 * @method LineItemStateTransitionMessage setFromState(StateReference $fromState = null)
 * @method StateReference getToState()
 * @method LineItemStateTransitionMessage setToState(StateReference $toState = null)
 * @method int getVersion()
 * @method LineItemStateTransitionMessage setVersion(int $version = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method LineItemStateTransitionMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 */
class LineItemStateTransitionMessage extends Message
{
    const MESSAGE_TYPE = 'LineItemStateTransition';

    public function fieldDefinitions()
    {
        $definitions = array_merge(
            parent::fieldDefinitions(),
            [
                'lineItemId' => [static::TYPE => 'string'],
                'transitionDate' => [
                    static::TYPE => DateTime::class,
                    static::DECORATOR => DateTimeDecorator::class
                ],
                'quantity' => [static::TYPE => 'int'],
                'fromState' => [static::TYPE => StateReference::class],
                'toState' => [static::TYPE => StateReference::class],
            ]
        );

        return $definitions;
    }
}
