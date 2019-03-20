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
 * @link https://docs.commercetools.com/http-api-projects-messages.html#customeraddressremoved-message
 * @method string getId()
 * @method CustomerAddressRemovedMessage setId(string $id = null)
 * @method int getVersion()
 * @method CustomerAddressRemovedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method CustomerAddressRemovedMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method CustomerAddressRemovedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method CustomerAddressRemovedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method CustomerAddressRemovedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method CustomerAddressRemovedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method CustomerAddressRemovedMessage setType(string $type = null)
 * @method Address getAddress()
 * @method CustomerAddressRemovedMessage setAddress(Address $address = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method CustomerAddressRemovedMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 */
class CustomerAddressRemovedMessage extends Message
{
    const MESSAGE_TYPE = 'CustomerAddressRemoved';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['address'] = [static::TYPE => Address::class];

        return $definitions;
    }
}
