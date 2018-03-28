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
     * @return TaxCategorySetKeyAction
     */
    public function setKey()
    {
        return TaxCategorySetKeyAction::of();
    }

    /**
     * @return TaxCategoryReplaceTaxRateAction
     */
    public function replaceTaxRate()
    {
        return TaxCategoryReplaceTaxRateAction::of();
    }

    /**
     * @return TaxCategoryRemoveTaxRateAction
     */
    public function removeTaxRate()
    {
        return TaxCategoryRemoveTaxRateAction::of();
    }

    /**
     * @return TaxCategoryChangeNameAction
     */
    public function changeName()
    {
        return TaxCategoryChangeNameAction::of();
    }

    /**
     * @return TaxCategoryAddTaxRateAction
     */
    public function addTaxRate()
    {
        return TaxCategoryAddTaxRateAction::of();
    }

    /**
     * @return TaxCategorySetDescriptionAction
     */
    public function setDescription()
    {
        return TaxCategorySetDescriptionAction::of();
    }
}
