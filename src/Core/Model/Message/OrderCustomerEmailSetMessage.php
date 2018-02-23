<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-projects-messages.html#ordercustomeremailset-message
 *
 * @method string getId()
 * @method OrderCustomerEmailSetMessage setId(string $id = null)
 * @method int getVersion()
 * @method OrderCustomerEmailSetMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method OrderCustomerEmailSetMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method OrderCustomerEmailSetMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method OrderCustomerEmailSetMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method OrderCustomerEmailSetMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method OrderCustomerEmailSetMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method OrderCustomerEmailSetMessage setType(string $type = null)
 * @method string getEmail()
 * @method OrderCustomerEmailSetMessage setEmail(string $email = null)
 */
class OrderCustomerEmailSetMessage extends Message
{
    const MESSAGE_TYPE = 'OrderCustomerEmailSet';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['email'] = [static::TYPE => 'string'];

        return $definitions;
    }
}
