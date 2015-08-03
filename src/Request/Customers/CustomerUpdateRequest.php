<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 11.02.15, 14:35
 */

namespace Commercetools\Core\Request\Customers;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractUpdateRequest;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\Customers
 * @apidoc http://dev.sphere.io/http-api-projects-customers.html#update-customer
 * @method Customer mapResponse(ApiResponseInterface $response)
 */
class CustomerUpdateRequest extends AbstractUpdateRequest
{
    protected $resultClass = '\Commercetools\Core\Model\Customer\Customer';

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
