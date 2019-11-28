<?php

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\CustomerGroup\CustomerGroupReference;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-projects-messages.html#ordercustomergroupset-message
 *
 * @method string getId()
 * @method OrderCustomerGroupSetMessage setId(string $id = null)
 * @method int getVersion()
 * @method OrderCustomerGroupSetMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method OrderCustomerGroupSetMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method OrderCustomerGroupSetMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method OrderCustomerGroupSetMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method OrderCustomerGroupSetMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method OrderCustomerGroupSetMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method OrderCustomerGroupSetMessage setType(string $type = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method OrderCustomerGroupSetMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 * @method CustomerGroupReference getCustomerGroup()
 * @method OrderCustomerGroupSetMessage setCustomerGroup(CustomerGroupReference $customerGroup = null)
 * @method CustomerGroupReference getOldCustomerGroup()
 * @method OrderCustomerGroupSetMessage setOldCustomerGroup(CustomerGroupReference $oldCustomerGroup = null)
 */
class OrderCustomerGroupSetMessage extends Message
{
    const MESSAGE_TYPE = 'OrderCustomerGroupSet';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['customerGroup'] = [static::TYPE => CustomerGroupReference::class];
        $definitions['oldCustomerGroup'] = [static::TYPE => CustomerGroupReference::class];

        return $definitions;
    }
}
