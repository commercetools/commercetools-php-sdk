<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\DiscountCodes;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractQueryRequest;
use Sphere\Core\Model\DiscountCode\DiscountCodeCollection;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * @package Sphere\Core\Request\DiscountCodes
 * @method DiscountCodeCollection mapResponse(ApiResponseInterface $response)
 */
class DiscountCodesQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = '\Sphere\Core\Model\DiscountCode\DiscountCodeCollection';

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
