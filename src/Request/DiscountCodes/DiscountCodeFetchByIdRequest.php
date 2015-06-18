<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\DiscountCodes;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractFetchByIdRequest;

/**
 * Class DiscountCodeFetchByIdRequest
 * @package Sphere\Core\Request\DiscountCodes
 * @link http://dev.sphere.io/http-api-projects-discountCodes.html#discount-code-by-id
 */
class DiscountCodeFetchByIdRequest extends AbstractFetchByIdRequest
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
}
