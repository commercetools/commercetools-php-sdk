<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\DiscountCodes;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractDeleteByIdRequest;

/**
 * Class DiscountCodeDeleteByIdRequest
 * @package Sphere\Core\Request\DiscountCodes
 * @link http://dev.sphere.io/http-api-projects-discountCodes.html#delete-discount-code
 */
class DiscountCodeDeleteByIdRequest extends AbstractDeleteByIdRequest
{
    protected $resultClass = '\Sphere\Core\Model\DiscountCode\DiscountCode';

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     */
    public function __construct($id, $version, Context $context = null)
    {
        parent::__construct(DiscountCodesEndpoint::endpoint(), $id, $version, $context);
    }
}
