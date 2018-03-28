<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Request\Types\Command\TypeChangeLocalizedEnumValueOrderAction;
use Commercetools\Core\Request\Types\Command\TypeChangeNameAction;
use Commercetools\Core\Request\Types\Command\TypeRemoveFieldDefinitionAction;
use Commercetools\Core\Request\Types\Command\TypeChangeLabelAction;
use Commercetools\Core\Request\Types\Command\TypeChangeKeyAction;
use Commercetools\Core\Request\Types\Command\TypeAddFieldDefinitionAction;
use Commercetools\Core\Request\Types\Command\TypeSetDescriptionAction;
use Commercetools\Core\Request\Types\Command\TypeChangeFieldDefinitionOrderAction;
use Commercetools\Core\Request\Types\Command\TypeAddLocalizedEnumValueAction;
use Commercetools\Core\Request\Types\Command\TypeChangeEnumValueOrderAction;
use Commercetools\Core\Request\Types\Command\TypeAddEnumValueAction;

class TypesActionBuilder
{
    /**
     * @return TypeChangeLocalizedEnumValueOrderAction
     */
    public function changeLocalizedEnumValueOrder()
    {
        return TypeChangeLocalizedEnumValueOrderAction::of();
    }

    /**
     * @return TypeChangeNameAction
     */
    public function changeName()
    {
        return TypeChangeNameAction::of();
    }

    /**
     * @return TypeRemoveFieldDefinitionAction
     */
    public function removeFieldDefinition()
    {
        return TypeRemoveFieldDefinitionAction::of();
    }

    /**
     * @return TypeChangeLabelAction
     */
    public function changeLabel()
    {
        return TypeChangeLabelAction::of();
    }

    /**
     * @return TypeChangeKeyAction
     */
    public function changeKey()
    {
        return TypeChangeKeyAction::of();
    }

    /**
     * @return TypeAddFieldDefinitionAction
     */
    public function addFieldDefinition()
    {
        return TypeAddFieldDefinitionAction::of();
    }

    /**
     * @return TypeSetDescriptionAction
     */
    public function setDescription()
    {
        return TypeSetDescriptionAction::of();
    }

    /**
     * @return TypeChangeFieldDefinitionOrderAction
     */
    public function changeFieldDefinitionOrder()
    {
        return TypeChangeFieldDefinitionOrderAction::of();
    }

    /**
     * @return TypeAddLocalizedEnumValueAction
     */
    public function addLocalizedEnumValue()
    {
        return TypeAddLocalizedEnumValueAction::of();
    }

    /**
     * @return TypeChangeEnumValueOrderAction
     */
    public function changeEnumValueOrder()
    {
        return TypeChangeEnumValueOrderAction::of();
    }

    /**
     * @return TypeAddEnumValueAction
     */
    public function addEnumValue()
    {
        return TypeAddEnumValueAction::of();
    }
}
