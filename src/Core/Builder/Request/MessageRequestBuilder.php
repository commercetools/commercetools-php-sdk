<?php
// phpcs:disable Generic.Files.LineLength
namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\Messages\MessageByIdGetRequest;
use Commercetools\Core\Request\Messages\MessageQueryRequest;

class MessageRequestBuilder
{

    /**
     * @link https://docs.commercetools.com/http-api-projects-messages.html#get-message-by-id
     * @param string $id
     * @return MessageByIdGetRequest
     */
    public function getById($id)
    {
        $request = MessageByIdGetRequest::ofId($id);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-messages.html#query-messages
     *
     * @return MessageQueryRequest
     */
    public function query()
    {
        $request = MessageQueryRequest::of();
        return $request;
    }

    /**
     * @return MessageRequestBuilder
     */
    public function of()
    {
        return new self();
    }
}
