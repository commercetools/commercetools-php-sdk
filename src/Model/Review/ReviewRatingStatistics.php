<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Model\Review;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Review
 *
 * @method float getAverageRating()
 * @method ReviewRatingStatistics setAverageRating(float $averageRating = null)
 * @method float getHighestRating()
 * @method ReviewRatingStatistics setHighestRating(float $highestRating = null)
 * @method float getLowestRating()
 * @method ReviewRatingStatistics setLowestRating(float $lowestRating = null)
 * @method int getCount()
 * @method ReviewRatingStatistics setCount(int $count = null)
 * @method array getRatingsDistribution()
 * @method ReviewRatingStatistics setRatingsDistribution(array $ratingsDistribution = null)
 */
class ReviewRatingStatistics extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'averageRating' => [static::TYPE => 'float'],
            'highestRating' => [static::TYPE => 'float'],
            'lowestRating' => [static::TYPE => 'float'],
            'count' => [static::TYPE => 'int'],
            'ratingsDistribution' => [static::TYPE => 'array'],
        ];
    }
}
