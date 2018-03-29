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
     * @link https://docs.commercetools.com/http-api-projects-types.html#change-the-order-of-localizedenumvalues
     * @param array $data
     * @return TypeChangeLocalizedEnumValueOrderAction
     */
    public function changeLocalizedEnumValueOrder(array $data = [])
    {
        return new TypeChangeLocalizedEnumValueOrderAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-types.html#change-name
     * @param array $data
     * @return TypeChangeNameAction
     */
    public function changeName(array $data = [])
    {
        return new TypeChangeNameAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-types.html#remove-fielddefinition
     * @param array $data
     * @return TypeRemoveFieldDefinitionAction
     */
    public function removeFieldDefinition(array $data = [])
    {
        return new TypeRemoveFieldDefinitionAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-types.html#change-fielddefinition-label
     * @param array $data
     * @return TypeChangeLabelAction
     */
    public function changeLabel(array $data = [])
    {
        return new TypeChangeLabelAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-types.html#change-key
     * @param array $data
     * @return TypeChangeKeyAction
     */
    public function changeKey(array $data = [])
    {
        return new TypeChangeKeyAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-types.html#add-fielddefinition
     * @param array $data
     * @return TypeAddFieldDefinitionAction
     */
    public function addFieldDefinition(array $data = [])
    {
        return new TypeAddFieldDefinitionAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-types.html#set-description
     * @param array $data
     * @return TypeSetDescriptionAction
     */
    public function setDescription(array $data = [])
    {
        return new TypeSetDescriptionAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-types.html#change-the-order-of-fielddefinitions
     * @param array $data
     * @return TypeChangeFieldDefinitionOrderAction
     */
    public function changeFieldDefinitionOrder(array $data = [])
    {
        return new TypeChangeFieldDefinitionOrderAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-types.html#add-localizedenumvalue-to-fielddefinition
     * @param array $data
     * @return TypeAddLocalizedEnumValueAction
     */
    public function addLocalizedEnumValue(array $data = [])
    {
        return new TypeAddLocalizedEnumValueAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-types.html#change-the-order-of-enumvalues
     * @param array $data
     * @return TypeChangeEnumValueOrderAction
     */
    public function changeEnumValueOrder(array $data = [])
    {
        return new TypeChangeEnumValueOrderAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-types.html#add-enumvalue-to-fielddefinition
     * @param array $data
     * @return TypeAddEnumValueAction
     */
    public function addEnumValue(array $data = [])
    {
        return new TypeAddEnumValueAction($data);
    }

    /**
     * @return TypesActionBuilder
     */
    public function of()
    {
        return new self();
    }
}
