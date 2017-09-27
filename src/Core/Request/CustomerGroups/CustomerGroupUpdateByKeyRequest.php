<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CustomerGroups;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractUpdateByKeyRequest;
use Commercetools\Core\Model\CustomerGroup\CustomerGroup;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\CustomerGroups
 * @link https://dev.commercetools.com/http-api-projects-customerGroups.html#update-customergroup
 * @method CustomerGroup mapResponse(ApiResponseInterface $response)
 * @method CustomerGroup mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class CustomerGroupUpdateByKeyRequest extends AbstractUpdateByKeyRequest
{
    protected $resultClass = CustomerGroup::class;

    /**
     * @param string $key
     * @param int $version
     * @param array $actions
     * @param Context $context
     */
    public function __construct($key, $version, array $actions = [], Context $context = null)
    {
        parent::__construct(CustomerGroupsEndpoint::endpoint(), $key, $version, $actions, $context);
    }

    /**
     * @param string $key
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofKeyAndVersion($key, $version, Context $context = null)
    {
        return new static($key, $version, [], $context);
    }
}
