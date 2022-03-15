<?php
// phpcs:disable Generic.Files.LineLength
namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\OrderSearch\OrderSearchRequest;

class OrderSearchRequestBuilder
{

    /**
     *
     * @param string $
     * @return OrderSearchRequest
     */
    public function getBy($)
    {
        $request = OrderSearchRequest::of($);
        return $request;
    }

    /**
     * @return OrderSearchRequestBuilder
     */
    public function of()
    {
        return new self();
    }
}
