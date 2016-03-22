<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\State\StateReference;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://dev.commercetools.com/http-api-projects-messages.html#payment-status-state-transition-message
 * @method string getId()
 * @method PaymentStatusStateTransitionMessage setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method PaymentStatusStateTransitionMessage setCreatedAt(\DateTime $createdAt = null)
 * @method int getSequenceNumber()
 * @method PaymentStatusStateTransitionMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method PaymentStatusStateTransitionMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method PaymentStatusStateTransitionMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method PaymentStatusStateTransitionMessage setType(string $type = null)
 * @method StateReference getState()
 * @method PaymentStatusStateTransitionMessage setState(StateReference $state = null)
 */
class PaymentStatusStateTransitionMessage extends StateTransitionMessage
{
    const MESSAGE_TYPE = 'PaymentStatusStateTransition';
}
