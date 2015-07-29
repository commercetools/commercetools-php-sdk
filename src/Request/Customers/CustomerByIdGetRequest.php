<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 11.02.15, 14:17
 */

namespace Sphere\Core\Request\Customers;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractByIdGetRequest;
use Sphere\Core\Model\Customer\Customer;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * @package Sphere\Core\Request\Customers
 * @apidoc http://dev.sphere.io/http-api-projects-customers.html#customer-by-id
 * @method Customer mapResponse(ApiResponseInterface $response)
 */
class CustomerByIdGetRequest extends AbstractByIdGetRequest
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
