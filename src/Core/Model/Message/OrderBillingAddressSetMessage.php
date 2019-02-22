<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Common\Address;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-projects-messages.html#orderbillingaddressset-message
 *
 * @method string getId()
 * @method OrderBillingAddressSetMessage setId(string $id = null)
 * @method int getVersion()
 * @method OrderBillingAddressSetMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method OrderBillingAddressSetMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method OrderBillingAddressSetMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method OrderBillingAddressSetMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method OrderBillingAddressSetMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method OrderBillingAddressSetMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method OrderBillingAddressSetMessage setType(string $type = null)
 * @method Address getAddress()
 * @method OrderBillingAddressSetMessage setAddress(Address $address = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method OrderBillingAddressSetMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 */
class OrderBillingAddressSetMessage extends Message
{
    const MESSAGE_TYPE = 'OrderBillingAddressSet';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['address'] = [static::TYPE => Address::class];

        return $definitions;
    }
}
