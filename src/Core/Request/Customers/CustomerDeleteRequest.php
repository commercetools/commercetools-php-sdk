<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 12.02.15, 12:12
 */

namespace Commercetools\Core\Request\Customers;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractDeleteRequest;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Customers
 * @link https://docs.commercetools.com/http-api-projects-customers.html#delete-customer
 * @method Customer mapResponse(ApiResponseInterface $response)
 * @method Customer mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class CustomerDeleteRequest extends AbstractDeleteRequest
{
    protected $resultClass = Customer::class;

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     */
    public function __construct($id, $version, Context $context = null)
    {
        parent::__construct(CustomersEndpoint::endpoint(), $id, $version, $context);
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
