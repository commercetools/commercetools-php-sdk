<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CustomerGroups;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\CustomerGroup\CustomerGroup;
use Commercetools\Core\Request\AbstractByKeyGetRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\CustomerGroups
 * @link https://docs.commercetools.com/http-api-projects-customerGroups.html#get-customergroup-by-key
 * @method CustomerGroup mapResponse(ApiResponseInterface $response)
 * @method CustomerGroup mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class CustomerGroupByKeyGetRequest extends AbstractByKeyGetRequest
{
    protected $resultClass = CustomerGroup::class;

    /**
     * @param string $key
     * @param Context $context
     */
    public function __construct($key, Context $context = null)
    {
        parent::__construct(CustomerGroupsEndpoint::endpoint(), $key, $context);
    }

    /**
     * @param string $key
     * @param Context $context
     * @return static
     */
    public static function ofKey($key, Context $context = null)
    {
        return new static($key, $context);
    }
}
