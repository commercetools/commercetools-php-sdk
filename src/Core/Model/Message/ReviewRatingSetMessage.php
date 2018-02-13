<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-projects-messages.html#reviewratingset-message
 * @method string getId()
 * @method ReviewRatingSetMessage setId(string $id = null)
 * @method int getVersion()
 * @method ReviewRatingSetMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ReviewRatingSetMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method ReviewRatingSetMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method ReviewRatingSetMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method ReviewRatingSetMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method ReviewRatingSetMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method ReviewRatingSetMessage setType(string $type = null)
 * @method float getOldRating()
 * @method ReviewRatingSetMessage setOldRating(float $oldRating = null)
 * @method float getNewRating()
 * @method ReviewRatingSetMessage setNewRating(float $newRating = null)
 * @method bool getIncludedInStatistics()
 * @method ReviewRatingSetMessage setIncludedInStatistics(bool $includedInStatistics = null)
 * @method Reference getTarget()
 * @method ReviewRatingSetMessage setTarget(Reference $target = null)
 */
class ReviewRatingSetMessage extends Message
{
    const MESSAGE_TYPE = 'ReviewRatingSet';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['oldRating'] = [static::TYPE => 'float'];
        $definitions['newRating'] = [static::TYPE => 'float'];
        $definitions['includedInStatistics'] = [static::TYPE => 'bool'];
        $definitions['target'] = [static::TYPE => Reference::class];

        return $definitions;
    }
}
