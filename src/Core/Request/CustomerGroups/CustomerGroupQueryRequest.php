<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CustomerGroups;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupCollection;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\CustomerGroups
 * @link https://docs.commercetools.com/http-api-projects-customerGroups.html#query-customergroups
 * @method CustomerGroupCollection mapResponse(ApiResponseInterface $response)
 * @method CustomerGroupCollection mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class CustomerGroupQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = CustomerGroupCollection::class;

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(CustomerGroupsEndpoint::endpoint(), $context);
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
