<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\DiscountCodes;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractByIdGetRequest;
use Commercetools\Core\Model\DiscountCode\DiscountCode;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\DiscountCodes
 * @link https://docs.commercetools.com/http-api-projects-discountCodes.html#get-discountcode-by-id
 * @method DiscountCode mapResponse(ApiResponseInterface $response)
 * @method DiscountCode mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class DiscountCodeByIdGetRequest extends AbstractByIdGetRequest
{
    protected $resultClass = DiscountCode::class;

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(DiscountCodesEndpoint::endpoint(), $id, $context);
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
