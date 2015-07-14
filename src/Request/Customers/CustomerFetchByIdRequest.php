<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 11.02.15, 14:17
 */

namespace Sphere\Core\Request\Customers;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractFetchByIdRequest;
use Sphere\Core\Model\Customer\Customer;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * Class CustomerFetchByIdRequest
 * @package Sphere\Core\Request\Customers
 * @link http://dev.sphere.io/http-api-projects-customers.html#customer-by-id
 * @method Customer mapResponse(ApiResponseInterface $response)
 */
class CustomerFetchByIdRequest extends AbstractFetchByIdRequest
{
    protected $resultClass = '\Sphere\Core\Model\Customer\Customer';

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(CustomersEndpoint::endpoint(), $id, $context);
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
