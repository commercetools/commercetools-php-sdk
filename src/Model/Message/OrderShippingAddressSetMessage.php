<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Common\Address;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://dev.commercetools.com/http-api-projects-messages.html#ordershippingaddressset-message
 *
 * @method string getId()
 * @method OrderShippingAddressSetMessage setId(string $id = null)
 * @method int getVersion()
 * @method OrderShippingAddressSetMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method OrderShippingAddressSetMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method OrderShippingAddressSetMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method OrderShippingAddressSetMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method OrderShippingAddressSetMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method OrderShippingAddressSetMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method OrderShippingAddressSetMessage setType(string $type = null)
 * @method Address getAddress()
 * @method OrderShippingAddressSetMessage setAddress(Address $address = null)
 */
class OrderShippingAddressSetMessage extends Message
{
    const MESSAGE_TYPE = 'OrderShippingAddressSet';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['address'] = [static::TYPE => Address::class];

        return $definitions;
    }
}
