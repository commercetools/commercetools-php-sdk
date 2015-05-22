<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Comments;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractQueryRequest;

/**
 * Class CommentsQueryRequest
 * @package Sphere\Core\Request\Comments
 * @link http://dev.sphere.io/http-api-projects-comments.html#comments-by-query
 */
class CommentsQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = '\Sphere\Core\Model\Comment\CommentCollection';

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(CommentsEndpoint::endpoint(), $context);
    }
}
