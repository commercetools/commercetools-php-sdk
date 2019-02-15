<?php
/**
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Customer\CustomerReference;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupReference;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-projects-messages.html#ordercustomerset-message
 *
 * @method string getId()
 * @method OrderCustomerSetMessage setId(string $id = null)
 * @method int getVersion()
 * @method OrderCustomerSetMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method OrderCustomerSetMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method OrderCustomerSetMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method OrderCustomerSetMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method OrderCustomerSetMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method OrderCustomerSetMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method OrderCustomerSetMessage setType(string $type = null)
 * @method CustomerReference getCustomer()
 * @method OrderCustomerSetMessage setCustomer(CustomerReference $customer = null)
 * @method CustomerGroupReference getCustomerGroup()
 * @method OrderCustomerSetMessage setCustomerGroup(CustomerGroupReference $customerGroup = null)
 * @method CustomerReference getOldCustomer()
 * @method OrderCustomerSetMessage setOldCustomer(CustomerReference $oldCustomer = null)
 * @method CustomerGroupReference getOldCustomerGroup()
 * @method OrderCustomerSetMessage setOldCustomerGroup(CustomerGroupReference $oldCustomerGroup = null)
 */
class OrderCustomerSetMessage extends Message
{
    const MESSAGE_TYPE = 'OrderCustomerSet';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['customer'] = [static::TYPE => CustomerReference::class];
        $definitions['customerGroup'] = [static::TYPE => CustomerGroupReference::class];
        $definitions['oldCustomer'] = [static::TYPE => CustomerReference::class];
        $definitions['oldCustomerGroup'] = [static::TYPE => CustomerGroupReference::class];

        return $definitions;
    }
}
