<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://dev.commercetools.com/http-api-projects-messages.html#productunpublished-message
 * @method string getId()
 * @method ProductUnpublishedMessage setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ProductUnpublishedMessage setCreatedAt(DateTime $createdAt = null)
 * @method int getSequenceNumber()
 * @method ProductUnpublishedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method ProductUnpublishedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method ProductUnpublishedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method ProductUnpublishedMessage setType(string $type = null)
 * @method int getVersion()
 * @method ProductUnpublishedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method ProductUnpublishedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 */
class ProductUnpublishedMessage extends Message
{
    const MESSAGE_TYPE = 'ProductUnpublished';
}
