<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Messages;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractFetchByIdRequest;
use Sphere\Core\Model\Message\Message;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * @package Sphere\Core\Request\Messages
 * @link http://dev.sphere.io/http-api-projects-messages.html#message-by-id
 * @method Message mapResponse(ApiResponseInterface $response)
 */
class MessageFetchByIdRequest extends AbstractFetchByIdRequest
{
    protected $resultClass = '\Sphere\Core\Model\Message\Message';

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(MessagesEndpoint::endpoint(), $id, $context);
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
