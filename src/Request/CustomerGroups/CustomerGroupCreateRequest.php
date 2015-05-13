<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CustomerGroups;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\CustomerGroup\CustomerGroupDraft;
use Sphere\Core\Request\AbstractCreateRequest;

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
}
