<?php

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\ProductSelection\IndividualProductSelectionType;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 *
 * @method string getId()
 * @method ProductSelectionCreatedMessage setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ProductSelectionCreatedMessage setCreatedAt(DateTime $createdAt = null)
 * @method int getSequenceNumber()
 * @method ProductSelectionCreatedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method ProductSelectionCreatedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method ProductSelectionCreatedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method ProductSelectionCreatedMessage setType(string $type = null)
 * @method int getVersion()
 * @method ProductSelectionCreatedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method ProductSelectionCreatedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method ProductSelectionCreatedMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 * @method IndividualProductSelectionType getProductSelection()
 * @method ProductSelectionCreatedMessage setProductSelection(IndividualProductSelectionType $productSelection = null)
 */
class ProductSelectionCreatedMessage extends Message
{
    const MESSAGE_TYPE = 'ProductSelectionCreated';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['productSelection'] = [static::TYPE => IndividualProductSelectionType::class];

        return $definitions;
    }
}
