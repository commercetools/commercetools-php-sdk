<?php

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Product\ProductReference;
use DateTime;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\Message
 *
 * @method string getId()
 * @method ProductSelectionProductRemovedMessage setId(string $id = null)
 * @method int getVersion()
 * @method ProductSelectionProductRemovedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ProductSelectionProductRemovedMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method ProductSelectionProductRemovedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method ProductSelectionProductRemovedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method ProductSelectionProductRemovedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method ProductSelectionProductRemovedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method ProductSelectionProductRemovedMessage setType(string $type = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method ProductSelectionProductRemovedMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 * @method ProductReference getProduct()
 * @method ProductSelectionProductRemovedMessage setProduct(ProductReference $product = null)
 */
class ProductSelectionProductRemovedMessage extends Message
{
    const MESSAGE_TYPE = 'ProductSelectionProductRemoved';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['product'] = [static::TYPE => ProductReference::class];

        return $definitions;
    }
}
