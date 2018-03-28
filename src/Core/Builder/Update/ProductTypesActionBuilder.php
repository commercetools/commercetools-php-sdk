<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeLocalizedEnumLabelAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeSetInputTipAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeLabelAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeAddAttributeDefinitionAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangePlainEnumLabelAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeAddPlainEnumValueAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeRemoveAttributeDefinitionAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangePlainEnumValueOrderAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeSetKeyAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeDescriptionAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeAttributeConstraintAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeNameAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeLocalizedEnumValueOrderAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeIsSearchableAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeAttributeOrderAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeAddLocalizedEnumValueAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeInputHintAction;

class ProductTypesActionBuilder
{
    /**
     * @return ProductTypeChangeLocalizedEnumLabelAction
     */
    public function changeLocalizedEnumValueLabel()
    {
        return ProductTypeChangeLocalizedEnumLabelAction::of();
    }

    /**
     * @return ProductTypeSetInputTipAction
     */
    public function setInputTip()
    {
        return ProductTypeSetInputTipAction::of();
    }

    /**
     * @return ProductTypeChangeLabelAction
     */
    public function changeLabel()
    {
        return ProductTypeChangeLabelAction::of();
    }

    /**
     * @return ProductTypeAddAttributeDefinitionAction
     */
    public function addAttributeDefinition()
    {
        return ProductTypeAddAttributeDefinitionAction::of();
    }

    /**
     * @return ProductTypeChangePlainEnumLabelAction
     */
    public function changePlainEnumValueLabel()
    {
        return ProductTypeChangePlainEnumLabelAction::of();
    }

    /**
     * @return ProductTypeAddPlainEnumValueAction
     */
    public function addPlainEnumValue()
    {
        return ProductTypeAddPlainEnumValueAction::of();
    }

    /**
     * @return ProductTypeRemoveAttributeDefinitionAction
     */
    public function removeAttributeDefinition()
    {
        return ProductTypeRemoveAttributeDefinitionAction::of();
    }

    /**
     * @return ProductTypeChangePlainEnumValueOrderAction
     */
    public function changePlainEnumValueOrder()
    {
        return ProductTypeChangePlainEnumValueOrderAction::of();
    }

    /**
     * @return ProductTypeSetKeyAction
     */
    public function setKey()
    {
        return ProductTypeSetKeyAction::of();
    }

    /**
     * @return ProductTypeChangeDescriptionAction
     */
    public function changeDescription()
    {
        return ProductTypeChangeDescriptionAction::of();
    }

    /**
     * @return ProductTypeChangeAttributeConstraintAction
     */
    public function changeAttributeConstraint()
    {
        return ProductTypeChangeAttributeConstraintAction::of();
    }

    /**
     * @return ProductTypeChangeNameAction
     */
    public function changeName()
    {
        return ProductTypeChangeNameAction::of();
    }

    /**
     * @return ProductTypeChangeLocalizedEnumValueOrderAction
     */
    public function changeLocalizedEnumValueOrder()
    {
        return ProductTypeChangeLocalizedEnumValueOrderAction::of();
    }

    /**
     * @return ProductTypeChangeIsSearchableAction
     */
    public function changeIsSearchable()
    {
        return ProductTypeChangeIsSearchableAction::of();
    }

    /**
     * @return ProductTypeChangeAttributeOrderAction
     */
    public function changeAttributeOrder()
    {
        return ProductTypeChangeAttributeOrderAction::of();
    }

    /**
     * @return ProductTypeAddLocalizedEnumValueAction
     */
    public function addLocalizedEnumValue()
    {
        return ProductTypeAddLocalizedEnumValueAction::of();
    }

    /**
     * @return ProductTypeChangeInputHintAction
     */
    public function changeInputHint()
    {
        return ProductTypeChangeInputHintAction::of();
    }
}
