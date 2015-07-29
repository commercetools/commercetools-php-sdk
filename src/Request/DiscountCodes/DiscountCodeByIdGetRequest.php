<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\DiscountCodes;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractByIdGetRequest;
use Sphere\Core\Model\DiscountCode\DiscountCode;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * @package Sphere\Core\Request\DiscountCodes
 * @apidoc http://dev.sphere.io/http-api-projects-discountCodes.html#discount-code-by-id
 * @method DiscountCode mapResponse(ApiResponseInterface $response)
 */
class DiscountCodeByIdGetRequest extends AbstractByIdGetRequest
{
    protected $resultClass = '\Sphere\Core\Model\DiscountCode\DiscountCode';

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
