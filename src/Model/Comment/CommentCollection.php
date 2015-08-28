<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Comment;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Comment
 *
 * @method Comment current()
 * @method CommentCollection add(Comment $element)
 * @method Comment getAt($offset)
 */
class CommentCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Comment\Comment';
}
