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
 * @method ProductStateTransitionMessage setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ProductStateTransitionMessage setCreatedAt(\DateTime $createdAt = null)
 * @method int getSequenceNumber()
 * @method ProductStateTransitionMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method ProductStateTransitionMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method ProductStateTransitionMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method ProductStateTransitionMessage setType(string $type = null)
 * @method StateReference getState()
 * @method ProductStateTransitionMessage setState(StateReference $state = null)
 */
class ProductStateTransitionMessage extends StateTransitionMessage
{
    const MESSAGE_TYPE = 'ProductStateTransition';
}
