<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\CustomField\CustomFieldObject;

/**
 * @package Commercetools\Core\Model\Message
 *
 * @method string getId()
 * @method PaymentInteractionAddedMessage setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method PaymentInteractionAddedMessage setCreatedAt(\DateTime $createdAt = null)
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
 */
class PaymentInteractionAddedMessage extends Message
{
    const MESSAGE_TYPE = 'PaymentInteractionAdded';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['interaction'] = [static::TYPE => '\Commercetools\Core\Model\CustomField\CustomFieldObject'];

        return $definitions;
    }
}
