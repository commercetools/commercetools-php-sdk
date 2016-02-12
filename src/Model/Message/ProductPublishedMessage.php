<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Product\ProductProjection;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://dev.commercetools.com/http-api-projects-messages.html#product-published-message
 * @method string getId()
 * @method ProductPublishedMessage setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ProductPublishedMessage setCreatedAt(\DateTime $createdAt = null)
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
 */
class ProductPublishedMessage extends Message
{
    const MESSAGE_TYPE = 'ProductPublished';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['productProjection'] = [static::TYPE => '\Commercetools\Core\Model\Product\ProductProjection'];

        return $definitions;
    }
}
