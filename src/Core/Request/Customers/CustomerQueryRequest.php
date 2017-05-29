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
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Customers
 * @link https://dev.commercetools.com/http-api-projects-customers.html#get-customer-by-id
 * @method CustomerCollection mapResponse(ApiResponseInterface $response)
 * @method CustomerCollection mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class CustomerQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = CustomerCollection::class;

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
