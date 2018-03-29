<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Request\CustomField\Command\SetCustomFieldAction;
use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;

class CustomFieldActionBuilder
{
    /**
     *
     * @param array $data
     * @return SetCustomFieldAction
     */
    public function setCustomField(array $data = [])
    {
        return new SetCustomFieldAction($data);
    }

    /**
     *
     * @param array $data
     * @return SetCustomTypeAction
     */
    public function setCustomType(array $data = [])
    {
        return new SetCustomTypeAction($data);
    }

    /**
     * @return CustomFieldActionBuilder
     */
    public function of()
    {
        return new self();
    }
}
