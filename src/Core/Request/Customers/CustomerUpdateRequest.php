<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 11.02.15, 14:35
 */

namespace Commercetools\Core\Request\Customers;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractUpdateRequest;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Customers
 * @link https://docs.commercetools.com/http-api-projects-customers.html#update-customer
 * @method Customer mapResponse(ApiResponseInterface $response)
 * @method Customer mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class CustomerUpdateRequest extends AbstractUpdateRequest
{
    protected $resultClass = Customer::class;

    /**
     * @param string $id
     * @param int $version
     * @param array $actions
     * @param Context $context
     */
    public function __construct($id, $version, array $actions = [], Context $context = null)
    {
        parent::__construct(CustomersEndpoint::endpoint(), $id, $version, $actions, $context);
    }

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofIdAndVersion($id, $version, Context $context = null)
    {
        return new static($id, $version, [], $context);
    }
}
