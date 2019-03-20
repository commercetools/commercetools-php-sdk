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
 * @link https://docs.commercetools.com/http-api-projects-messages.html#paymentstatusstatetransition-message
 * @method string getId()
 * @method PaymentStatusStateTransitionMessage setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method PaymentStatusStateTransitionMessage setCreatedAt(DateTime $createdAt = null)
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
 * @method int getVersion()
 * @method PaymentStatusStateTransitionMessage setVersion(int $version = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method PaymentStatusStateTransitionMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method bool getForce()
 * @method PaymentStatusStateTransitionMessage setForce(bool $force = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method PaymentStatusStateTransitionMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 */
class PaymentStatusStateTransitionMessage extends StateTransitionMessage
{
    const MESSAGE_TYPE = 'PaymentStatusStateTransition';
}
