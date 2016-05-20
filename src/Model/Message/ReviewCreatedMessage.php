<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Review\Review;

/**
 * @package Commercetools\Core\Model\Message
 *
 * @method string getId()
 * @method ReviewCreatedMessage setId(string $id = null)
 * @method int getVersion()
 * @method ReviewCreatedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ReviewCreatedMessage setCreatedAt(\DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method ReviewCreatedMessage setLastModifiedAt(\DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method ReviewCreatedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method ReviewCreatedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method ReviewCreatedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method ReviewCreatedMessage setType(string $type = null)
 * @method Review getReview()
 * @method ReviewCreatedMessage setReview(Review $review = null)
 */
class ReviewCreatedMessage extends Message
{
    const MESSAGE_TYPE = 'ReviewCreated';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['review'] = [static::TYPE => '\Commercetools\Core\Model\Review\Review'];

        return $definitions;
    }
}
