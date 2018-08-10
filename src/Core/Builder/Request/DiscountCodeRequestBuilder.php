<?php

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\DiscountCodes\DiscountCodeByIdGetRequest;
use Commercetools\Core\Request\DiscountCodes\DiscountCodeCreateRequest;
use Commercetools\Core\Model\DiscountCode\DiscountCodeDraft;
use Commercetools\Core\Request\DiscountCodes\DiscountCodeDeleteRequest;
use Commercetools\Core\Model\DiscountCode\DiscountCode;
use Commercetools\Core\Request\DiscountCodes\DiscountCodeQueryRequest;
use Commercetools\Core\Request\DiscountCodes\DiscountCodeUpdateRequest;

class DiscountCodeRequestBuilder
{

    /**
     * @link https://docs.commercetools.com/http-api-projects-discountCodes.html#get-discountcode-by-id
     * @param string $id
     * @return DiscountCodeByIdGetRequest
     */
    public function getById($id)
    {
        $request = DiscountCodeByIdGetRequest::ofId($id);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-discountCodes.html#create-a-discountcode
     * @param DiscountCodeDraft $discountCode
     * @return DiscountCodeCreateRequest
     */
    public function create(DiscountCodeDraft $discountCode)
    {
        $request = DiscountCodeCreateRequest::ofDraft($discountCode);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-discountCodes.html#delete-discountcode
     * @param DiscountCode $discountCode
     * @return DiscountCodeDeleteRequest
     */
    public function delete(DiscountCode $discountCode)
    {
        $request = DiscountCodeDeleteRequest::ofIdAndVersion($discountCode->getId(), $discountCode->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-discountCodes.html#query-discountcodes
     * @param 
     * @return DiscountCodeQueryRequest
     */
    public function query()
    {
        $request = DiscountCodeQueryRequest::of();
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-discountCodes.html#update-discountcode
     * @param DiscountCode $discountCode
     * @return DiscountCodeUpdateRequest
     */
    public function update(DiscountCode $discountCode)
    {
        $request = DiscountCodeUpdateRequest::ofIdAndVersion($discountCode->getId(), $discountCode->getVersion());
        return $request;
    }

    /**
     * @return DiscountCodeRequestBuilder
     */
    public function of()
    {
        return new self();
    }
}
