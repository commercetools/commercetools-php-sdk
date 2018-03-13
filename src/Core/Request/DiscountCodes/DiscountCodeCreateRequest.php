<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\DiscountCodes;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\DiscountCode\DiscountCodeDraft;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Model\DiscountCode\DiscountCode;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\DiscountCodes
 * @link https://docs.commercetools.com/http-api-projects-discountCodes.html#create-a-discountcode
 * @method DiscountCode mapResponse(ApiResponseInterface $response)
 * @method DiscountCode mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class DiscountCodeCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = DiscountCode::class;

    /**
     * @param DiscountCodeDraft $discountCode
     * @param Context $context
     */
    public function __construct(DiscountCodeDraft $discountCode, Context $context = null)
    {
        parent::__construct(DiscountCodesEndpoint::endpoint(), $discountCode, $context);
    }

    /**
     * @param DiscountCodeDraft $discountCode
     * @param Context $context
     * @return static
     */
    public static function ofDraft(DiscountCodeDraft $discountCode, Context $context = null)
    {
        return new static($discountCode, $context);
    }
}
