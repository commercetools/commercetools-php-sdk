<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\State\StateReference;

/**
 * @package Commercetools\Core\Model\Message
 *
 * @method string getId()
 * @method OrderStateTransitionMessage setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method OrderStateTransitionMessage setCreatedAt(\DateTime $createdAt = null)
 * @method int getSequenceNumber()
 * @method OrderStateTransitionMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method OrderStateTransitionMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method OrderStateTransitionMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method OrderStateTransitionMessage setType(string $type = null)
 * @method StateReference getState()
 * @method OrderStateTransitionMessage setState(StateReference $state = null)
 */
class OrderStateTransitionMessage extends StateTransitionMessage
{
    const MESSAGE_TYPE = 'OrderStateTransition';
}
