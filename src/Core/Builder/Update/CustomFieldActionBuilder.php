<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Request\CustomField\Command\SetCustomFieldAction;
use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;

class CustomFieldActionBuilder
{
    /**
     * @return SetCustomFieldAction
     */
    public function setCustomField()
    {
        return SetCustomFieldAction::of();
    }

    /**
     * @return SetCustomTypeAction
     */
    public function setCustomType()
    {
        return SetCustomTypeAction::of();
    }
}
