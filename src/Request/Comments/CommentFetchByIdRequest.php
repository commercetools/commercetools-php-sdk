<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Comments;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractFetchByIdRequest;
use Sphere\Core\Model\Comment\Comment;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * Class CommentFetchByIdRequest
 * @package Sphere\Core\Request\Comments
 * @link http://dev.sphere.io/http-api-projects-comments.html#comment-by-id
 * @method Comment mapResponse(ApiResponseInterface $response)
 */
class CommentFetchByIdRequest extends AbstractFetchByIdRequest
{
    protected $resultClass = '\Sphere\Core\Model\Comment\Comment';

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(CommentsEndpoint::endpoint(), $id, $context);
    }

    /**
     * @param string $id
     * @param Context $context
     * @return static
     */
    public static function ofId($id, Context $context = null)
    {
        return new static($id, $context);
    }
}
