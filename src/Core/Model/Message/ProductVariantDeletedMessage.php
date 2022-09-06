<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Product\ProductVariant;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-projects-messages.html#productvariantdeleted-message
 * @method string getId()
 * @method ProductVariantDeletedMessage setId(string $id = null)
 * @method int getVersion()
 * @method ProductVariantDeletedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ProductVariantDeletedMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method ProductVariantDeletedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method ProductVariantDeletedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method ProductVariantDeletedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method ProductVariantDeletedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method ProductVariantDeletedMessage setType(string $type = null)
 * @method array getRemovedImageUrls()
 * @method ProductVariantDeletedMessage setRemovedImageUrls(array $removedImageUrls = null)
 * @method ProductVariant getVariant()
 * @method ProductVariantDeletedMessage setVariant(ProductVariant $variant = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method ProductVariantDeletedMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 */
class ProductVariantDeletedMessage extends Message
{
    const MESSAGE_TYPE = 'ProductVariantDeleted';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['removedImageUrls'] = [static::TYPE => 'array'];
        $definitions['variant'] = [static::TYPE => ProductVariant::class, static::OPTIONAL => true];

        return $definitions;
    }
}
