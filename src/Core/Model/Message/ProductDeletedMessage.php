<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Product\ProductProjection;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-projects-messages.html#productdeleted-message
 * @method string getId()
 * @method ProductDeletedMessage setId(string $id = null)
 * @method int getVersion()
 * @method ProductDeletedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ProductDeletedMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method ProductDeletedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method ProductDeletedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method ProductDeletedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method ProductDeletedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method ProductDeletedMessage setType(string $type = null)
 * @method array getRemovedImageUrls()
 * @method ProductDeletedMessage setRemovedImageUrls(array $removedImageUrls = null)
 * @method ProductProjection getCurrentProjection()
 * @method ProductDeletedMessage setCurrentProjection(ProductProjection $currentProjection = null)
 */
class ProductDeletedMessage extends Message
{
    const MESSAGE_TYPE = 'ProductDeleted';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['removedImageUrls'] = [static::TYPE => 'array'];
        $definitions['currentProjection'] = [static::TYPE => ProductProjection::class];

        return $definitions;
    }
}
