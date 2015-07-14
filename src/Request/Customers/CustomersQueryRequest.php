<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 11.02.15, 14:19
 */

namespace Sphere\Core\Request\Customers;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractQueryRequest;
use Sphere\Core\Model\Customer\CustomerCollection;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * Class CustomersQueryRequest
 * @package Sphere\Core\Request\Customers
 * @link http://dev.sphere.io/http-api-projects-customers.html#customers-by-query
 * @method CustomerCollection mapResponse(ApiResponseInterface $response)
 */
class CustomersQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = '\Sphere\Core\Model\Customer\CustomerCollection';

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(CustomersEndpoint::endpoint(), $context);
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
