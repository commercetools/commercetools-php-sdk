<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 11.02.15, 14:17
 */

namespace Commercetools\Core\Request\Customers;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractByIdGetRequest;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Customers
 * @link https://dev.commercetools.com/http-api-projects-customers.html#get-customer-by-id
 * @method Customer mapResponse(ApiResponseInterface $response)
 * @method Customer mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class CustomerByIdGetRequest extends AbstractByIdGetRequest
{
    protected $resultClass = Customer::class;

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
