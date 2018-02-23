<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Review\Review;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-projects-messages.html#reviewcreated-message
 * @method string getId()
 * @method ReviewCreatedMessage setId(string $id = null)
 * @method int getVersion()
 * @method ReviewCreatedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ReviewCreatedMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method ReviewCreatedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
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
        $definitions['review'] = [static::TYPE => Review::class];

        return $definitions;
    }
}
