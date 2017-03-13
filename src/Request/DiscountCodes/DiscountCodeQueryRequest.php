<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\DiscountCodes;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Model\DiscountCode\DiscountCodeCollection;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\DiscountCodes
 * @link https://dev.commercetools.com/http-api-projects-discountCodes.html#query-discountcodes
 * @method DiscountCodeCollection mapResponse(ApiResponseInterface $response)
 * @method DiscountCodeCollection mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class DiscountCodeQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = DiscountCodeCollection::class;

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(DiscountCodesEndpoint::endpoint(), $context);
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
