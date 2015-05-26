<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CustomerGroups;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractDeleteByIdRequest;

/**
 * Class CustomerGroupDeleteByIdRequest
 * @package Sphere\Core\Request\CustomerGroups
 * @link http://dev.sphere.io/http-api-projects-customerGroups.html#delete-customer-group
 */
class CustomerGroupDeleteByIdRequest extends AbstractDeleteByIdRequest
{
    protected $resultClass = '\Sphere\Core\Model\CustomerGroup\CustomerGroup';

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     */
    public function __construct($id, $version, Context $context = null)
    {
        parent::__construct(CustomerGroupsEndpoint::endpoint(), $id, $version, $context);
    }
}
