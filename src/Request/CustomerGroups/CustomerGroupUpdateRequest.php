<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CustomerGroups;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractUpdateRequest;
use Sphere\Core\Model\CustomerGroup\CustomerGroup;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * Class CustomerGroupUpdateRequest
 * @package Sphere\Core\Request\CustomerGroups
 * @link http://dev.sphere.io/http-api-projects-customerGroups.html#update-customer-group
 * @method CustomerGroup mapResponse(ApiResponseInterface $response)
 */
class CustomerGroupUpdateRequest extends AbstractUpdateRequest
{
    protected $resultClass = '\Sphere\Core\Model\CustomerGroup\CustomerGroup';

    /**
     * @param string $id
     * @param string $version
     * @param array $actions
     * @param Context $context
     */
    public function __construct($id, $version, array $actions = [], Context $context = null)
    {
        parent::__construct(CustomerGroupsEndpoint::endpoint(), $id, $version, $actions, $context);
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
