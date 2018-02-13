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
 * @link https://docs.commercetools.com/http-api-projects-messages.html#productstatetransition-message
 * @method string getId()
 * @method ProductStateTransitionMessage setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ProductStateTransitionMessage setCreatedAt(DateTime $createdAt = null)
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
 * @method int getVersion()
 * @method ProductStateTransitionMessage setVersion(int $version = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method ProductStateTransitionMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method bool getForce()
 * @method ProductStateTransitionMessage setForce(bool $force = null)
 */
class ProductStateTransitionMessage extends StateTransitionMessage
{
    const MESSAGE_TYPE = 'ProductStateTransition';
}
