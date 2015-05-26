<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CustomerGroups;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractQueryRequest;

/**
 * Class CustomerGroupsQueryRequest
 * @package Sphere\Core\Request\CustomerGroups
 * @link http://dev.sphere.io/http-api-projects-customerGroups.html#customer-groups-by-query
 */
class CustomerGroupsQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = '\Sphere\Core\Model\CustomerGroup\CustomerGroupCollection';

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(CustomerGroupsEndpoint::endpoint(), $context);
    }
}
