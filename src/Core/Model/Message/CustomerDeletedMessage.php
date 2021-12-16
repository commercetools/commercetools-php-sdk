<?php

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Customer\Customer;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-projects-messages.html#customerdeleted-message
 * @method string getId()
 * @method CustomerDeletedMessage setId(string $id = null)
 * @method DateTimeDecorator getDeletedAt()
 * @method CustomerDeletedMessage setDeletedAt(DateTime $createdAt = null)
 * @method int getSequenceNumber()
 * @method CustomerDeletedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method CustomerDeletedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method CustomerDeletedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method CustomerDeletedMessage setType(string $type = null)
 * @method int getVersion()
 * @method CustomerDeletedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method CustomerDeletedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method CustomerDeletedMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 * @method DateTimeDecorator getCreatedAt()
 * @method CustomerDeletedMessage setCreatedAt(DateTime $createdAt = null)
 */
class CustomerDeletedMessage extends Message
{
    const MESSAGE_TYPE = 'CustomerDeleted';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();

        return $definitions;
    }
}
