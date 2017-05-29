<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Customer\Customer;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://dev.commercetools.com/http-api-projects-messages.html#customercreated-message
 * @method string getId()
 * @method CustomerCreatedMessage setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method CustomerCreatedMessage setCreatedAt(DateTime $createdAt = null)
 * @method int getSequenceNumber()
 * @method CustomerCreatedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method CustomerCreatedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method CustomerCreatedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method CustomerCreatedMessage setType(string $type = null)
 * @method Customer getCustomer()
 * @method CustomerCreatedMessage setCustomer(Customer $customer = null)
 * @method int getVersion()
 * @method CustomerCreatedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method CustomerCreatedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 */
class CustomerCreatedMessage extends Message
{
    const MESSAGE_TYPE = 'CustomerCreated';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['customer'] = [static::TYPE => Customer::class];

        return $definitions;
    }
}
