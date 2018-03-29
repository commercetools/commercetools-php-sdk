<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Request\TaxCategories\Command\TaxCategorySetKeyAction;
use Commercetools\Core\Request\TaxCategories\Command\TaxCategoryReplaceTaxRateAction;
use Commercetools\Core\Request\TaxCategories\Command\TaxCategoryRemoveTaxRateAction;
use Commercetools\Core\Request\TaxCategories\Command\TaxCategoryChangeNameAction;
use Commercetools\Core\Request\TaxCategories\Command\TaxCategoryAddTaxRateAction;
use Commercetools\Core\Request\TaxCategories\Command\TaxCategorySetDescriptionAction;

class TaxCategoriesActionBuilder
{
    /**
     * @link https://docs.commercetools.com/http-api-projects-taxCategories.html#set-key
     * @param array $data
     * @return TaxCategorySetKeyAction
     */
    public function setKey(array $data = [])
    {
        return new TaxCategorySetKeyAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-taxCategories.html#replace-taxrate
     * @param array $data
     * @return TaxCategoryReplaceTaxRateAction
     */
    public function replaceTaxRate(array $data = [])
    {
        return new TaxCategoryReplaceTaxRateAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-taxCategories.html#remove-taxrate
     * @param array $data
     * @return TaxCategoryRemoveTaxRateAction
     */
    public function removeTaxRate(array $data = [])
    {
        return new TaxCategoryRemoveTaxRateAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-taxCategories.html#change-name
     * @param array $data
     * @return TaxCategoryChangeNameAction
     */
    public function changeName(array $data = [])
    {
        return new TaxCategoryChangeNameAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-taxCategories.html#add-taxrate
     * @param array $data
     * @return TaxCategoryAddTaxRateAction
     */
    public function addTaxRate(array $data = [])
    {
        return new TaxCategoryAddTaxRateAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-taxCategories.html#set-description
     * @param array $data
     * @return TaxCategorySetDescriptionAction
     */
    public function setDescription(array $data = [])
    {
        return new TaxCategorySetDescriptionAction($data);
    }

    /**
     * @return TaxCategoriesActionBuilder
     */
    public function of()
    {
        return new self();
    }
}
