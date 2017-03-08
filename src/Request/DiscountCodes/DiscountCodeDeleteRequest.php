<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\DiscountCodes;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractDeleteRequest;
use Commercetools\Core\Model\DiscountCode\DiscountCode;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\DiscountCodes
 * @link https://dev.commercetools.com/http-api-projects-discountCodes.html#delete-discountcode
 * @method DiscountCode mapResponse(ApiResponseInterface $response)
 * @method DiscountCode mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class DiscountCodeDeleteRequest extends AbstractDeleteRequest
{
    protected $resultClass = DiscountCode::class;

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     */
    public function __construct($id, $version, Context $context = null)
    {
        parent::__construct(DiscountCodesEndpoint::endpoint(), $id, $version, $context);
    }

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofIdAndVersion($id, $version, Context $context = null)
    {
        return new static($id, $version, $context);
    }
}
