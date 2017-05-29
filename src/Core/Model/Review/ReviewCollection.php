<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Review;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Review
 * @link https://dev.commercetools.com/http-api-projects-reviews.html#review
 * @method Review current()
 * @method ReviewCollection add(Review $element)
 * @method Review getAt($offset)
 * @method Review getById($offset)
 */
class ReviewCollection extends Collection
{
    protected $type = Review::class;
}
