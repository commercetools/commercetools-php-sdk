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
 *
 * @method string getId()
 * @method ProductCreatedMessage setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ProductCreatedMessage setCreatedAt(\DateTime $createdAt = null)
 * @method int getSequenceNumber()
 * @method ProductCreatedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method ProductCreatedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method ProductCreatedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method ProductCreatedMessage setType(string $type = null)
 * @method ProductProjection getProductProjection()
 * @method ProductCreatedMessage setProductProjection(ProductProjection $productProjection = null)
 */
class ProductCreatedMessage extends Message
{
    const MESSAGE_TYPE = 'ProductCreated';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['productProjection'] = [static::TYPE => '\Commercetools\Core\Model\Product\ProductProjection'];

        return $definitions;
    }
}
