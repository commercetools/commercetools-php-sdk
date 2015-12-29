<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\Message
 *
 * @method string getId()
 * @method ProductUnpublishedMessage setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ProductUnpublishedMessage setCreatedAt(\DateTime $createdAt = null)
 * @method int getSequenceNumber()
 * @method ProductUnpublishedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method ProductUnpublishedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method ProductUnpublishedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method ProductUnpublishedMessage setType(string $type = null)
 */
class ProductUnpublishedMessage extends Message
{
    const MESSAGE_TYPE = 'ProductUnpublished';
}
