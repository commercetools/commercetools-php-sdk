<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Messages;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractQueryRequest;
use Sphere\Core\Model\Message\MessageCollection;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * @package Sphere\Core\Request\Messages
 * @link http://dev.sphere.io/http-api-projects-messages.html#messages-by-query
 * @method MessageCollection mapResponse(ApiResponseInterface $response)
 */
class MessageQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = '\Sphere\Core\Model\Message\MessageCollection';

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(MessagesEndpoint::endpoint(), $context);
    }

    /**
     * @param Context $context
     * @return static
     */
    public static function of(Context $context = null)
    {
        return new static($context);
    }
}
