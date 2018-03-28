<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodAddShippingRateAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodChangeIsDefaultAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodChangeTaxCategoryAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodSetKeyAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodAddZoneAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodRemoveZoneAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodChangeNameAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodSetPredicateAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodRemoveShippingRateAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodSetDescriptionAction;

class ShippingMethodsActionBuilder
{
    /**
     * @return ShippingMethodAddShippingRateAction
     */
    public function addShippingRate()
    {
        return ShippingMethodAddShippingRateAction::of();
    }

    /**
     * @return ShippingMethodChangeIsDefaultAction
     */
    public function changeIsDefault()
    {
        return ShippingMethodChangeIsDefaultAction::of();
    }

    /**
     * @return ShippingMethodChangeTaxCategoryAction
     */
    public function changeTaxCategory()
    {
        return ShippingMethodChangeTaxCategoryAction::of();
    }

    /**
     * @return ShippingMethodSetKeyAction
     */
    public function setKey()
    {
        return ShippingMethodSetKeyAction::of();
    }

    /**
     * @return ShippingMethodAddZoneAction
     */
    public function addZone()
    {
        return ShippingMethodAddZoneAction::of();
    }

    /**
     * @return ShippingMethodRemoveZoneAction
     */
    public function removeZone()
    {
        return ShippingMethodRemoveZoneAction::of();
    }

    /**
     * @return ShippingMethodChangeNameAction
     */
    public function changeName()
    {
        return ShippingMethodChangeNameAction::of();
    }

    /**
     * @return ShippingMethodSetPredicateAction
     */
    public function setPredicate()
    {
        return ShippingMethodSetPredicateAction::of();
    }

    /**
     * @return ShippingMethodRemoveShippingRateAction
     */
    public function removeShippingRate()
    {
        return ShippingMethodRemoveShippingRateAction::of();
    }

    /**
     * @return ShippingMethodSetDescriptionAction
     */
    public function setDescription()
    {
        return ShippingMethodSetDescriptionAction::of();
    }
}
