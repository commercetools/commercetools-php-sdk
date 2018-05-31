<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-projects-messages.html#customeraddresschanged-message
 * @method string getId()
 * @method CustomerAddressChangedMessage setId(string $id = null)
 * @method int getVersion()
 * @method CustomerAddressChangedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method CustomerAddressChangedMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method CustomerAddressChangedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method CustomerAddressChangedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method CustomerAddressChangedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method CustomerAddressChangedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method CustomerAddressChangedMessage setType(string $type = null)
 * @method Address getAddress()
 * @method CustomerAddressChangedMessage setAddress(Address $address = null)
 */
class CustomerAddressChangedMessage extends Message
{
    const MESSAGE_TYPE = 'CustomerAddressChanged';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['address'] = [static::TYPE => Address::class];

        return $definitions;
    }
}
