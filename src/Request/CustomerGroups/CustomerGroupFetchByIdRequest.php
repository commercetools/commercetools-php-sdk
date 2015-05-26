<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CustomerGroups;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractFetchByIdRequest;

/**
 * Class CustomerGroupFetchByIdRequest
 * @package Sphere\Core\Request\CustomerGroups
 * @link http://dev.sphere.io/http-api-projects-customerGroups.html#customer-group-by-id
 */
class CustomerGroupFetchByIdRequest extends AbstractFetchByIdRequest
{
    protected $resultClass = '\Sphere\Core\Model\CustomerGroup\CustomerGroup';

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(CustomerGroupsEndpoint::endpoint(), $id, $context);
    }
}
