<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Messages;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Model\Message\MessageCollection;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Messages
 * @link https://dev.commercetools.com/http-api-projects-messages.html#query-messages
 * @method MessageCollection mapResponse(ApiResponseInterface $response)
 * @method MessageCollection mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class MessageQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = MessageCollection::class;

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
