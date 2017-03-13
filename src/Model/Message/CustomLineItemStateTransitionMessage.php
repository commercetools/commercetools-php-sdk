<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\State\StateReference;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://dev.commercetools.com/http-api-projects-messages.html#customlineitemstatetransition-message
 * @method string getId()
 * @method CustomLineItemStateTransitionMessage setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method CustomLineItemStateTransitionMessage setCreatedAt(DateTime $createdAt = null)
 * @method int getSequenceNumber()
 * @method CustomLineItemStateTransitionMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method CustomLineItemStateTransitionMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method CustomLineItemStateTransitionMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method CustomLineItemStateTransitionMessage setType(string $type = null)
 * @method string getCustomLineItemId()
 * @method CustomLineItemStateTransitionMessage setCustomLineItemId(string $customLineItemId = null)
 * @method DateTimeDecorator getTransitionDate()
 * @method CustomLineItemStateTransitionMessage setTransitionDate(DateTime $transitionDate = null)
 * @method int getQuantity()
 * @method CustomLineItemStateTransitionMessage setQuantity(int $quantity = null)
 * @method StateReference getFromState()
 * @method CustomLineItemStateTransitionMessage setFromState(StateReference $fromState = null)
 * @method StateReference getToState()
 * @method CustomLineItemStateTransitionMessage setToState(StateReference $toState = null)
 * @method int getVersion()
 * @method CustomLineItemStateTransitionMessage setVersion(int $version = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method CustomLineItemStateTransitionMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 */
class CustomLineItemStateTransitionMessage extends Message
{
    const MESSAGE_TYPE = 'CustomLineItemStateTransition';

    public function fieldDefinitions()
    {
        $definitions = array_merge(
            parent::fieldDefinitions(),
            [
                'customLineItemId' => [static::TYPE => 'string'],
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
