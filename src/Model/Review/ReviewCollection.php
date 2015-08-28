<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Review;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Review
 *
 * @method Review current()
 * @method ReviewCollection add(Review $element)
 * @method Review getAt($offset)
 */
class ReviewCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Review\Review';
}
