<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Request\CustomerGroups\Command\CustomerGroupSetKeyAction;
use Commercetools\Core\Request\CustomerGroups\Command\CustomerGroupChangeNameAction;

class CustomerGroupsActionBuilder
{
    /**
     * @return CustomerGroupSetKeyAction
     */
    public function setKey()
    {
        return CustomerGroupSetKeyAction::of();
    }

    /**
     * @return CustomerGroupChangeNameAction
     */
    public function changeName()
    {
        return CustomerGroupChangeNameAction::of();
    }
}
