<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Comments;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractUpdateRequest;

/**
 * Class CommentUpdateRequest
 * @package Sphere\Core\Request\Comments
 * @link http://dev.sphere.io/http-api-projects-comments.html#update-comment
 */
class CommentUpdateRequest extends AbstractUpdateRequest
{
    protected $resultClass = '\Sphere\Core\Model\Comment\Comment';

    /**
     * @param string $id
     * @param string $version
     * @param array $actions
     * @param Context $context
     */
    public function __construct($id, $version, array $actions = [], Context $context = null)
    {
        parent::__construct(CommentsEndpoint::endpoint(), $id, $version, $actions, $context);
    }
}
