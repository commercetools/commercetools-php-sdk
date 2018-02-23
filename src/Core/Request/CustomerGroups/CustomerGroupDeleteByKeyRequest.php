<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CustomerGroups;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractDeleteByKeyRequest;
use Commercetools\Core\Model\CustomerGroup\CustomerGroup;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\CustomerGroups
 * @link https://docs.commercetools.com/http-api-projects-customerGroups.html#delete-customergroup
 * @method CustomerGroup mapResponse(ApiResponseInterface $response)
 * @method CustomerGroup mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class CustomerGroupDeleteByKeyRequest extends AbstractDeleteByKeyRequest
{
    protected $resultClass = CustomerGroup::class;

    /**
     * @param string $key
     * @param int $version
     * @param Context $context
     */
    public function __construct($key, $version, Context $context = null)
    {
        parent::__construct(CustomerGroupsEndpoint::endpoint(), $key, $version, $context);
    }

    /**
     * @param string $key
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofKeyAndVersion($key, $version, Context $context = null)
    {
        return new static($key, $version, $context);
    }
}
