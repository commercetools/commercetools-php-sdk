<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CustomerGroups;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\CustomerGroup\CustomerGroupDraft;
use Sphere\Core\Request\AbstractCreateRequest;
use Sphere\Core\Model\CustomerGroup\CustomerGroup;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * @package Sphere\Core\Request\CustomerGroups
 * 
 * @method CustomerGroup mapResponse(ApiResponseInterface $response)
 */
class CustomerGroupCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Sphere\Core\Model\CustomerGroup\CustomerGroup';

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
