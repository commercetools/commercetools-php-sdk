<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupReference;
use DateTime;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-projects-messages.html#customergroupset-message
 * @method string getId()
 * @method CustomerGroupSetMessage setId(string $id = null)
 * @method int getVersion()
 * @method CustomerGroupSetMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method CustomerGroupSetMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method CustomerGroupSetMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method CustomerGroupSetMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method CustomerGroupSetMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method CustomerGroupSetMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method CustomerGroupSetMessage setType(string $type = null)
 * @method CustomerGroupReference getCustomerGroup()
 * @method CustomerGroupSetMessage setCustomerGroup(CustomerGroupReference $customerGroup = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method CustomerGroupSetMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 */
class CustomerGroupSetMessage extends Message
{
    const MESSAGE_TYPE = 'CustomerGroupSet';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['customerGroup'] = [static::TYPE => CustomerGroupReference::class, static::OPTIONAL => true];

        return $definitions;
    }
}
