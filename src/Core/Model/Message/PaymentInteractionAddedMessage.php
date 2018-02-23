<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-projects-messages.html#paymentinteractionadded-message
 * @method string getId()
 * @method PaymentInteractionAddedMessage setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method PaymentInteractionAddedMessage setCreatedAt(DateTime $createdAt = null)
 * @method int getSequenceNumber()
 * @method PaymentInteractionAddedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method PaymentInteractionAddedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method PaymentInteractionAddedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method PaymentInteractionAddedMessage setType(string $type = null)
 * @method CustomFieldObject getInteraction()
 * @method PaymentInteractionAddedMessage setInteraction(CustomFieldObject $interaction = null)
 * @method int getVersion()
 * @method PaymentInteractionAddedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method PaymentInteractionAddedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 */
class PaymentInteractionAddedMessage extends Message
{
    const MESSAGE_TYPE = 'PaymentInteractionAdded';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['interaction'] = [static::TYPE => CustomFieldObject::class];

        return $definitions;
    }
}
