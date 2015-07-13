<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Review;

use Sphere\Core\Model\Common\Collection;

/**
 * Class ReviewCollection
 * @package Sphere\Core\Model\Review
 * 
 * @method Review current()
 * @method Review getAt($offset)
 */
class ReviewCollection extends Collection
{
    protected $type = '\Sphere\Core\Model\Review\Review';
}
