<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Comment;

use Sphere\Core\Model\Common\Collection;

/**
 * @package Sphere\Core\Model\Comment
 * 
 * @method Comment current()
 * @method Comment getAt($offset)
 */
class CommentCollection extends Collection
{
    protected $type = '\Sphere\Core\Model\Comment\Comment';
}
