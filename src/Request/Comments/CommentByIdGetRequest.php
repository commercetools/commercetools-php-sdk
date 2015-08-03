<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Comments;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractByIdGetRequest;
use Commercetools\Core\Model\Comment\Comment;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\Comments
 * @apidoc http://dev.sphere.io/http-api-projects-comments.html#comment-by-id
 * @method Comment mapResponse(ApiResponseInterface $response)
 */
class CommentByIdGetRequest extends AbstractByIdGetRequest
{
    protected $resultClass = '\Commercetools\Core\Model\Comment\Comment';

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
