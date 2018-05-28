<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Model\DiscountCode\DiscountCode;
use Commercetools\Core\Model\DiscountCode\DiscountCodeDraft;
use Commercetools\Core\Request\DiscountCodes\DiscountCodeByIdGetRequest;
use Commercetools\Core\Request\DiscountCodes\DiscountCodeCreateRequest;
use Commercetools\Core\Request\DiscountCodes\DiscountCodeDeleteRequest;
use Commercetools\Core\Request\DiscountCodes\DiscountCodeQueryRequest;
use Commercetools\Core\Request\DiscountCodes\DiscountCodeUpdateRequest;

class DiscountCodeRequestBuilder
{
    /**
     * @return DiscountCodeQueryRequest
     */
    public function query()
    {
        return DiscountCodeQueryRequest::of();
    }

    /**
     * @param DiscountCode $discountCode
     * @return DiscountCodeUpdateRequest
     */
    public function update(DiscountCode $discountCode)
    {
        return DiscountCodeUpdateRequest::ofIdAndVersion($discountCode->getId(), $discountCode->getVersion());
    }

    /**
     * @param DiscountCodeDraft $discountCodeDraft
     * @return DiscountCodeCreateRequest
     */
    public function create(DiscountCodeDraft $discountCodeDraft)
    {
        return DiscountCodeCreateRequest::ofDraft($discountCodeDraft);
    }

    /**
     * @param DiscountCode $discountCode
     * @return DiscountCodeDeleteRequest
     */
    public function delete(DiscountCode $discountCode)
    {
        return DiscountCodeDeleteRequest::ofIdAndVersion($discountCode->getId(), $discountCode->getVersion());
    }

    /**
     * @param string $id
     * @return DiscountCodeByIdGetRequest
     */
    public function getById($id)
    {
        return DiscountCodeByIdGetRequest::ofId($id);
    }
}
