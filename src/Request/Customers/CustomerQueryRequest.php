<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 11.02.15, 14:19
 */

namespace Commercetools\Core\Request\Customers;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Model\Customer\CustomerCollection;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\Customers
 * @apidoc http://dev.sphere.io/http-api-projects-customers.html#customers-by-query
 * @method CustomerCollection mapResponse(ApiResponseInterface $response)
 */
class CustomerQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = '\Commercetools\Core\Model\Customer\CustomerCollection';

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
