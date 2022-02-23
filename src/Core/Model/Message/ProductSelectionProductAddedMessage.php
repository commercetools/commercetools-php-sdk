<?php


namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Product\ProductReference;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 *
 * @method string getId()
 * @method ProductSelectionProductAddedMessage setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ProductSelectionProductAddedMessage setCreatedAt(DateTime $createdAt = null)
 * @method int getSequenceNumber()
 * @method ProductSelectionProductAddedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method ProductSelectionProductAddedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method ProductSelectionProductAddedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method ProductSelectionProductAddedMessage setType(string $type = null)
 * @method int getVersion()
 * @method ProductSelectionProductAddedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method ProductSelectionProductAddedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method ProductSelectionProductAddedMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 * @method ProductReference getProduct()
 * @method ProductSelectionProductAddedMessage setProduct(ProductReference $product = null)
 */
class ProductSelectionProductAddedMessage extends Message
{
    const MESSAGE_TYPE = 'ProductSelectionProductAdded';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['product'] = [static::TYPE => ProductReference::class];

        return $definitions;
    }
}
