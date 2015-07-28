<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CustomerGroups;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractByIdGetRequest;
use Sphere\Core\Model\CustomerGroup\CustomerGroup;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * @package Sphere\Core\Request\CustomerGroups
 * @apidoc http://dev.sphere.io/http-api-projects-customerGroups.html#customer-group-by-id
 * @method CustomerGroup mapResponse(ApiResponseInterface $response)
 */
class CustomerGroupByIdGetRequest extends AbstractByIdGetRequest
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

    /**
     * @param string $id
     * @param Context $context
     * @return static
     */
    public static function ofId($id, Context $context = null)
    {
        return new static($id, $context);
    }
}
