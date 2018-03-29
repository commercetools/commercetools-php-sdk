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
     * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#add-shippingrate
     * @param array $data
     * @return ShippingMethodAddShippingRateAction
     */
    public function addShippingRate(array $data = [])
    {
        return new ShippingMethodAddShippingRateAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#change-isdefault
     * @param array $data
     * @return ShippingMethodChangeIsDefaultAction
     */
    public function changeIsDefault(array $data = [])
    {
        return new ShippingMethodChangeIsDefaultAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#change-taxcategory
     * @param array $data
     * @return ShippingMethodChangeTaxCategoryAction
     */
    public function changeTaxCategory(array $data = [])
    {
        return new ShippingMethodChangeTaxCategoryAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#set-key
     * @param array $data
     * @return ShippingMethodSetKeyAction
     */
    public function setKey(array $data = [])
    {
        return new ShippingMethodSetKeyAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#add-zone
     * @param array $data
     * @return ShippingMethodAddZoneAction
     */
    public function addZone(array $data = [])
    {
        return new ShippingMethodAddZoneAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#remove-zone
     * @param array $data
     * @return ShippingMethodRemoveZoneAction
     */
    public function removeZone(array $data = [])
    {
        return new ShippingMethodRemoveZoneAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#change-name
     * @param array $data
     * @return ShippingMethodChangeNameAction
     */
    public function changeName(array $data = [])
    {
        return new ShippingMethodChangeNameAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#set-predicate
     * @param array $data
     * @return ShippingMethodSetPredicateAction
     */
    public function setPredicate(array $data = [])
    {
        return new ShippingMethodSetPredicateAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#remove-shippingrate
     * @param array $data
     * @return ShippingMethodRemoveShippingRateAction
     */
    public function removeShippingRate(array $data = [])
    {
        return new ShippingMethodRemoveShippingRateAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#set-description
     * @param array $data
     * @return ShippingMethodSetDescriptionAction
     */
    public function setDescription(array $data = [])
    {
        return new ShippingMethodSetDescriptionAction($data);
    }

    /**
     * @return ShippingMethodsActionBuilder
     */
    public function of()
    {
        return new self();
    }
}
