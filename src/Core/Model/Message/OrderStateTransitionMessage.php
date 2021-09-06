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
 * @link https://docs.commercetools.com/http-api-projects-messages.html#orderstatetransition-message
 * @method string getId()
 * @method OrderStateTransitionMessage setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method OrderStateTransitionMessage setCreatedAt(DateTime $createdAt = null)
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
 * @method StateReference getOldState()
 * @method OrderStateTransitionMessage setOldState(StateReference $state = null)
 * @method int getVersion()
 * @method OrderStateTransitionMessage setVersion(int $version = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method OrderStateTransitionMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method bool getForce()
 * @method OrderStateTransitionMessage setForce(bool $force = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method OrderStateTransitionMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 */
class OrderStateTransitionMessage extends StateTransitionMessage
{
    const MESSAGE_TYPE = 'OrderStateTransition';
}
