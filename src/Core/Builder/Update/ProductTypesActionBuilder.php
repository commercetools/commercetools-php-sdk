<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Request\ProductTypes\Command\ProductTypeAddAttributeDefinitionAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeAddLocalizedEnumValueAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeAddPlainEnumValueAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeAttributeConstraintAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeAttributeNameAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeAttributeOrderAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeDescriptionAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeEnumKeyAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeInputHintAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeIsSearchableAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeLabelAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeLocalizedEnumLabelAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeLocalizedEnumValueOrderAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeNameAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangePlainEnumLabelAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangePlainEnumValueOrderAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeRemoveAttributeDefinitionAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeRemoveEnumValuesAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeSetInputTipAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeSetKeyAction;

class ProductTypesActionBuilder
{
    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#add-attributedefinition
     * @param array $data
     * @return ProductTypeAddAttributeDefinitionAction
     */
    public function addAttributeDefinition(array $data = [])
    {
        return ProductTypeAddAttributeDefinitionAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#add-localizableenumvalue-to-attributedefinition
     * @param array $data
     * @return ProductTypeAddLocalizedEnumValueAction
     */
    public function addLocalizedEnumValue(array $data = [])
    {
        return ProductTypeAddLocalizedEnumValueAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#add-plainenumvalue-to-attributedefinition
     * @param array $data
     * @return ProductTypeAddPlainEnumValueAction
     */
    public function addPlainEnumValue(array $data = [])
    {
        return ProductTypeAddPlainEnumValueAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-attributedefinition-attributeconstraint
     * @param array $data
     * @return ProductTypeChangeAttributeConstraintAction
     */
    public function changeAttributeConstraint(array $data = [])
    {
        return ProductTypeChangeAttributeConstraintAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-attributedefinition-name
     * @param array $data
     * @return ProductTypeChangeAttributeNameAction
     */
    public function changeAttributeName(array $data = [])
    {
        return ProductTypeChangeAttributeNameAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-the-order-of-attributedefinitions
     * @param array $data
     * @return ProductTypeChangeAttributeOrderAction
     */
    public function changeAttributeOrder(array $data = [])
    {
        return ProductTypeChangeAttributeOrderAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-description
     * @param array $data
     * @return ProductTypeChangeDescriptionAction
     */
    public function changeDescription(array $data = [])
    {
        return ProductTypeChangeDescriptionAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-the-key-of-an-enumvalue
     * @param array $data
     * @return ProductTypeChangeEnumKeyAction
     */
    public function changeEnumKey(array $data = [])
    {
        return ProductTypeChangeEnumKeyAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-attributedefinition-inputhint
     * @param array $data
     * @return ProductTypeChangeInputHintAction
     */
    public function changeInputHint(array $data = [])
    {
        return ProductTypeChangeInputHintAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-attributedefinition-issearchable
     * @param array $data
     * @return ProductTypeChangeIsSearchableAction
     */
    public function changeIsSearchable(array $data = [])
    {
        return ProductTypeChangeIsSearchableAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-attributedefinition-label
     * @param array $data
     * @return ProductTypeChangeLabelAction
     */
    public function changeLabel(array $data = [])
    {
        return ProductTypeChangeLabelAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-the-label-of-an-localizedenumvalue
     * @param array $data
     * @return ProductTypeChangeLocalizedEnumLabelAction
     */
    public function changeLocalizedEnumValueLabel(array $data = [])
    {
        return ProductTypeChangeLocalizedEnumLabelAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-the-order-of-localizedenumvalues
     * @param array $data
     * @return ProductTypeChangeLocalizedEnumValueOrderAction
     */
    public function changeLocalizedEnumValueOrder(array $data = [])
    {
        return ProductTypeChangeLocalizedEnumValueOrderAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-name
     * @param array $data
     * @return ProductTypeChangeNameAction
     */
    public function changeName(array $data = [])
    {
        return ProductTypeChangeNameAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-the-label-of-an-enumvalue
     * @param array $data
     * @return ProductTypeChangePlainEnumLabelAction
     */
    public function changePlainEnumValueLabel(array $data = [])
    {
        return ProductTypeChangePlainEnumLabelAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-the-order-of-enumvalues
     * @param array $data
     * @return ProductTypeChangePlainEnumValueOrderAction
     */
    public function changePlainEnumValueOrder(array $data = [])
    {
        return ProductTypeChangePlainEnumValueOrderAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#remove-attributedefinition
     * @param array $data
     * @return ProductTypeRemoveAttributeDefinitionAction
     */
    public function removeAttributeDefinition(array $data = [])
    {
        return ProductTypeRemoveAttributeDefinitionAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#remove-enumvalues-from-attributedefinition
     * @param array $data
     * @return ProductTypeRemoveEnumValuesAction
     */
    public function removeEnumValues(array $data = [])
    {
        return ProductTypeRemoveEnumValuesAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#set-attributedefinition-inputtip
     * @param array $data
     * @return ProductTypeSetInputTipAction
     */
    public function setInputTip(array $data = [])
    {
        return ProductTypeSetInputTipAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#set-key
     * @param array $data
     * @return ProductTypeSetKeyAction
     */
    public function setKey(array $data = [])
    {
        return ProductTypeSetKeyAction::fromArray($data);
    }

    /**
     * @return ProductTypesActionBuilder
     */
    public function of()
    {
        return new self();
    }
}
