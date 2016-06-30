<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CustomerGroups;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupCollection;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\CustomerGroups
 * @link https://dev.commercetools.com/http-api-projects-customerGroups.html#query-customergroups
 * @method CustomerGroupCollection mapResponse(ApiResponseInterface $response)
 */
class CustomerGroupQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = '\Commercetools\Core\Model\CustomerGroup\CustomerGroupCollection';

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
