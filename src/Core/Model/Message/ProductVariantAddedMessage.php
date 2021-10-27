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
 * @link https://docs.commercetools.com/http-api-projects-messages.html#productvariantadded-message
 * @method string getId()
 * @method ProductVariantAddedMessage setId(string $id = null)
 * @method int getVersion()
 * @method ProductVariantAddedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ProductVariantAddedMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method ProductVariantAddedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method ProductVariantAddedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method ProductVariantAddedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method ProductVariantAddedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method ProductVariantAddedMessage setType(string $type = null)
 * @method array getRemovedImageUrls()
 * @method ProductVariantAddedMessage setRemovedImageUrls(array $removedImageUrls = null)
 * @method ProductVariant getVariant()
 * @method ProductVariantAddedMessage setVariant(ProductVariant $variant = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method ProductVariantAddedMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 */
class ProductVariantAddedMessage extends Message
{
    const MESSAGE_TYPE = 'ProductVariantAdded';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['variant'] = [static::TYPE => ProductVariant::class];
        $definitions['staged'] = [static::TYPE => 'bool'];

        return $definitions;
    }
}
