<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Image;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Product\ProductProjection;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-projects-messages.html#productimageadded-message
 * @method string getId()
 * @method ProductImageAddedMessage setId(string $id = null)
 * @method int getVersion()
 * @method ProductImageAddedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ProductImageAddedMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method ProductImageAddedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method ProductImageAddedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method ProductImageAddedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method ProductImageAddedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method ProductImageAddedMessage setType(string $type = null)
 * @method int getVariantId()
 * @method ProductImageAddedMessage setVariantId(int $variantId = null)
 * @method Image getImage()
 * @method ProductImageAddedMessage setImage(Image $image = null)
 * @method bool getStaged()
 * @method ProductImageAddedMessage setStaged(bool $staged = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method ProductImageAddedMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 */
class ProductImageAddedMessage extends Message
{
    const MESSAGE_TYPE = 'ProductImageAdded';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['variantId'] = [static::TYPE => 'int'];
        $definitions['image'] = [static::TYPE => Image::class];
        $definitions['staged'] = [static::TYPE => 'bool'];

        return $definitions;
    }
}
