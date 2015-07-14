<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Comments;

use Sphere\Core\Model\Comment\CommentDraft;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractCreateRequest;
use Sphere\Core\Model\Comment\Comment;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * Class CommentCreateRequest
 * @package Sphere\Core\Request\Comments
 * 
 * @method Comment mapResponse(ApiResponseInterface $response)
 */
class CommentCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Sphere\Core\Model\Comment\Comment';

    /**
     * @param CommentDraft $comment
     * @param Context $context
     */
    public function __construct(CommentDraft $comment, Context $context = null)
    {
        parent::__construct(CommentsEndpoint::endpoint(), $comment, $context);
    }

    /**
     * @param CommentDraft $comment
     * @param Context $context
     * @return static
     */
    public static function ofDraft(CommentDraft $comment, Context $context = null)
    {
        return new static($comment, $context);
    }
}
