<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Request\CustomerGroups\Command\CustomerGroupSetKeyAction;
use Commercetools\Core\Request\CustomerGroups\Command\CustomerGroupChangeNameAction;

class CustomerGroupsActionBuilder
{
    /**
     * @link https://docs.commercetools.com/http-api-projects-customerGroups.html#set-key
     * @param array $data
     * @return CustomerGroupSetKeyAction
     */
    public function setKey(array $data = [])
    {
        return new CustomerGroupSetKeyAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customerGroups.html#change-name
     * @param array $data
     * @return CustomerGroupChangeNameAction
     */
    public function changeName(array $data = [])
    {
        return new CustomerGroupChangeNameAction($data);
    }

    /**
     * @return CustomerGroupsActionBuilder
     */
    public function of()
    {
        return new self();
    }
}
