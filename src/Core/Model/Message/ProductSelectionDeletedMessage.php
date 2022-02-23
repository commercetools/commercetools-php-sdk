<?php

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 *
 * @method string getId()
 * @method ProductSelectionDeletedMessage setId(string $id = null)
 * @method DateTimeDecorator getDeletedAt()
 * @method ProductSelectionDeletedMessage setDeletedAt(DateTime $createdAt = null)
 * @method int getSequenceNumber()
 * @method ProductSelectionDeletedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method ProductSelectionDeletedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method ProductSelectionDeletedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method ProductSelectionDeletedMessage setType(string $type = null)
 * @method int getVersion()
 * @method ProductSelectionDeletedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method ProductSelectionDeletedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method ProductSelectionDeletedMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 * @method DateTimeDecorator getCreatedAt()
 * @method ProductSelectionDeletedMessage setCreatedAt(DateTime $createdAt = null)
 */
class ProductSelectionDeletedMessage extends Message
{
    const MESSAGE_TYPE = 'ProductSelectionDeleted';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();

        return $definitions;
    }
}
