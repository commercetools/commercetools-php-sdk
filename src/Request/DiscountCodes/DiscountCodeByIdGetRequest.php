<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\DiscountCodes;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractByIdGetRequest;
use Commercetools\Core\Model\DiscountCode\DiscountCode;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\DiscountCodes
 * @apidoc http://dev.sphere.io/http-api-projects-discountCodes.html#discount-code-by-id
 * @method DiscountCode mapResponse(ApiResponseInterface $response)
 */
class DiscountCodeByIdGetRequest extends AbstractByIdGetRequest
{
    protected $resultClass = '\Commercetools\Core\Model\DiscountCode\DiscountCode';

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
