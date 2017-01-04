<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Messages;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractByIdGetRequest;
use Commercetools\Core\Model\Message\Message;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Messages
 * @link https://dev.commercetools.com/http-api-projects-messages.html#get-message-by-id
 * @method Message mapResponse(ApiResponseInterface $response)
 * @method Message mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class MessageByIdGetRequest extends AbstractByIdGetRequest
{
    protected $resultClass = Message::class;

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
