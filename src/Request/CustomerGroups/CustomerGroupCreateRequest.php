<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CustomerGroups;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupDraft;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Model\CustomerGroup\CustomerGroup;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\CustomerGroups
 * @link https://dev.commercetools.com/http-api-projects-customerGroups.html#create-customer-group
 * @method CustomerGroup mapResponse(ApiResponseInterface $response)
 */
class CustomerGroupCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Commercetools\Core\Model\CustomerGroup\CustomerGroup';

    /**
     * @param CustomerGroupDraft $customerGroup
     * @param Context $context
     */
    public function __construct(CustomerGroupDraft $customerGroup, Context $context = null)
    {
        parent::__construct(CustomerGroupsEndpoint::endpoint(), $customerGroup, $context);
    }

    /**
     * @param CustomerGroupDraft $customerGroup
     * @param Context $context
     * @return static
     */
    public static function ofDraft(CustomerGroupDraft $customerGroup, Context $context = null)
    {
        return new static($customerGroup, $context);
    }
}
