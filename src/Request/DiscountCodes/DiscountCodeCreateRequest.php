<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\DiscountCodes;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\DiscountCode\DiscountCodeDraft;
use Sphere\Core\Request\AbstractCreateRequest;

class DiscountCodeCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Sphere\Core\Model\DiscountCode\DiscountCode';

    /**
     * @param DiscountCodeDraft $discountCode
     * @param Context $context
     */
    public function __construct(DiscountCodeDraft $discountCode, Context $context = null)
    {
        parent::__construct(DiscountCodesEndpoint::endpoint(), $discountCode, $context);
    }
}
