<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Comments;

use Commercetools\Core\Model\Comment\CommentDraft;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Model\Comment\Comment;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\Comments
 *
 * @method Comment mapResponse(ApiResponseInterface $response)
 */
class CommentCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Commercetools\Core\Model\Comment\Comment';

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
