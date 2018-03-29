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
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-the-label-of-an-localizedenumvalue
     * @param array $data
     * @return ProductTypeChangeLocalizedEnumLabelAction
     */
    public function changeLocalizedEnumValueLabel(array $data = [])
    {
        return new ProductTypeChangeLocalizedEnumLabelAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#set-attributedefinition-inputtip
     * @param array $data
     * @return ProductTypeSetInputTipAction
     */
    public function setInputTip(array $data = [])
    {
        return new ProductTypeSetInputTipAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-attributedefinition-label
     * @param array $data
     * @return ProductTypeChangeLabelAction
     */
    public function changeLabel(array $data = [])
    {
        return new ProductTypeChangeLabelAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#add-attributedefinition
     * @param array $data
     * @return ProductTypeAddAttributeDefinitionAction
     */
    public function addAttributeDefinition(array $data = [])
    {
        return new ProductTypeAddAttributeDefinitionAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-the-label-of-an-enumvalue
     * @param array $data
     * @return ProductTypeChangePlainEnumLabelAction
     */
    public function changePlainEnumValueLabel(array $data = [])
    {
        return new ProductTypeChangePlainEnumLabelAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#add-plainenumvalue-to-attributedefinition
     * @param array $data
     * @return ProductTypeAddPlainEnumValueAction
     */
    public function addPlainEnumValue(array $data = [])
    {
        return new ProductTypeAddPlainEnumValueAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#remove-attributedefinition
     * @param array $data
     * @return ProductTypeRemoveAttributeDefinitionAction
     */
    public function removeAttributeDefinition(array $data = [])
    {
        return new ProductTypeRemoveAttributeDefinitionAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-the-order-of-enumvalues
     * @param array $data
     * @return ProductTypeChangePlainEnumValueOrderAction
     */
    public function changePlainEnumValueOrder(array $data = [])
    {
        return new ProductTypeChangePlainEnumValueOrderAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#set-key
     * @param array $data
     * @return ProductTypeSetKeyAction
     */
    public function setKey(array $data = [])
    {
        return new ProductTypeSetKeyAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-description
     * @param array $data
     * @return ProductTypeChangeDescriptionAction
     */
    public function changeDescription(array $data = [])
    {
        return new ProductTypeChangeDescriptionAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-attributedefinition-attributeconstraint
     * @param array $data
     * @return ProductTypeChangeAttributeConstraintAction
     */
    public function changeAttributeConstraint(array $data = [])
    {
        return new ProductTypeChangeAttributeConstraintAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-name
     * @param array $data
     * @return ProductTypeChangeNameAction
     */
    public function changeName(array $data = [])
    {
        return new ProductTypeChangeNameAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-the-order-of-localizedenumvalues
     * @param array $data
     * @return ProductTypeChangeLocalizedEnumValueOrderAction
     */
    public function changeLocalizedEnumValueOrder(array $data = [])
    {
        return new ProductTypeChangeLocalizedEnumValueOrderAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-attributedefinition-issearchable
     * @param array $data
     * @return ProductTypeChangeIsSearchableAction
     */
    public function changeIsSearchable(array $data = [])
    {
        return new ProductTypeChangeIsSearchableAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-the-order-of-attributedefinitions
     * @param array $data
     * @return ProductTypeChangeAttributeOrderAction
     */
    public function changeAttributeOrder(array $data = [])
    {
        return new ProductTypeChangeAttributeOrderAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#add-localizableenumvalue-to-attributedefinition
     * @param array $data
     * @return ProductTypeAddLocalizedEnumValueAction
     */
    public function addLocalizedEnumValue(array $data = [])
    {
        return new ProductTypeAddLocalizedEnumValueAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-attributedefinition-inputhint
     * @param array $data
     * @return ProductTypeChangeInputHintAction
     */
    public function changeInputHint(array $data = [])
    {
        return new ProductTypeChangeInputHintAction($data);
    }

    /**
     * @return ProductTypesActionBuilder
     */
    public function of()
    {
        return new self();
    }
}
