<?php

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\CustomerGroup\CustomerGroupReference;

class OrderCustomerGroupSetMessage extends Message
{
    const MESSAGE_TYPE = 'OrderCustomerGroupSet';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['customerGroup'] = [static::TYPE => CustomerGroupReference::class];
        $definitions['oldCustomerGroup'] = [static::TYPE => CustomerGroupReference::class];

        return $definitions;
    }
}
