<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Messages;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractFetchByIdRequest;

/**
 * Class MessageFetchByIdRequest
 * @package Sphere\Core\Request\Messages
 * @link http://dev.sphere.io/http-api-projects-messages.html#message-by-id
 */
class MessageFetchByIdRequest extends AbstractFetchByIdRequest
{
    protected $resultClass = '\Sphere\Core\Model\Common\JsonObject';

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(MessagesEndpoint::endpoint(), $id, $context);
    }
}
