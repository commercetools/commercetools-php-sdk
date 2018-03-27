<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\Messages\MessageByIdGetRequest;
use Commercetools\Core\Request\Messages\MessageQueryRequest;

class MessageRequestBuilder
{
    /**
     * @return MessageQueryRequest
     */
    public function query()
    {
        return MessageQueryRequest::of();
    }

    /**
     * @param $id
     * @return MessageByIdGetRequest
     */
    public function getById($id)
    {
        return MessageByIdGetRequest::ofId($id);
    }
}
