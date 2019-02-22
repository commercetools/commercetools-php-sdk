<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Product\ProductProjection;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-projects-messages.html#productpublished-message
 * @method string getId()
 * @method ProductPublishedMessage setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ProductPublishedMessage setCreatedAt(DateTime $createdAt = null)
 * @method int getSequenceNumber()
 * @method ProductPublishedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method ProductPublishedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method ProductPublishedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method ProductPublishedMessage setType(string $type = null)
 * @method ProductProjection getProductProjection()
 * @method ProductPublishedMessage setProductProjection(ProductProjection $productProjection = null)
 * @method int getVersion()
 * @method ProductPublishedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method ProductPublishedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method array getRemovedImageUrls()
 * @method ProductPublishedMessage setRemovedImageUrls(array $removedImageUrls = null)
 * @method string getScope()
 * @method ProductPublishedMessage setScope(string $scope = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method ProductPublishedMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 */
class ProductPublishedMessage extends Message
{
    const MESSAGE_TYPE = 'ProductPublished';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['removedImageUrls'] = [static::TYPE => 'array'];
        $definitions['productProjection'] = [static::TYPE => ProductProjection::class];
        $definitions['scope'] = [static::TYPE => 'string'];

        return $definitions;
    }
}
