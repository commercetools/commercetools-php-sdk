<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request;


use Sphere\Core\Model\Common\LocalizedString;

class GenericActionTest extends \PHPUnit_Framework_TestCase
{
    public function actionFieldProvider()
    {
        return [
            [
                '\Sphere\Core\Request\AbstractAction',
                ['action']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductAddExternalImageAction',
                ['action', 'variantId', 'image', 'staged']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductAddPriceAction',
                ['action', 'variantId', 'price', 'staged']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductAddToCategoryAction',
                ['action', 'category', 'staged']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductAddVariantAction',
                ['action', 'prices', 'sku', 'attributes', 'staged']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductChangeNameAction',
                ['action', 'name', 'staged']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductChangePriceAction',
                ['action', 'priceId', 'price', 'staged']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductChangeSlugAction',
                ['action', 'slug', 'staged']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductPublishAction',
                ['action']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductRemoveFromCategoryAction',
                ['action', 'category', 'staged']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductRemoveImageAction',
                ['action', 'variantId', 'imageUrl', 'staged']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductRemovePriceAction',
                ['action', 'priceId', 'staged']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductRemoveVariantAction',
                ['action', 'id', 'staged']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductRevertStagedChangesAction',
                ['action']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductSetAttributeAction',
                ['action', 'variantId', 'name', 'value', 'staged']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductSetAttributeInAllVariantsAction',
                ['action', 'name', 'value', 'staged']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductSetDescriptionAction',
                ['action', 'description', 'staged']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductSetMetaAttributesAction',
                ['action', 'metaTitle', 'metaDescription', 'metaKeywords', 'staged']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductSetMetaTitleAction',
                ['action', 'metaTitle']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductSetMetaDescriptionAction',
                ['action', 'metaDescription']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductSetMetaKeywordsAction',
                ['action', 'metaKeywords']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductSetSearchKeywordsAction',
                ['action', 'searchKeywords', 'staged']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductSetSKUAction',
                ['action', 'variantId', 'sku']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductSetTaxCategoryAction',
                ['action', 'taxCategory', 'staged']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductUnpublishAction',
                ['action']
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderAddDeliveryAction',
                ['action', 'items', 'parcels', 'measurements', 'trackingData']
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderAddParcelToDeliveryAction',
                ['action', 'deliveryId', 'measurements', 'trackingData']
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderAddReturnInfoAction',
                ['action', 'returnDate', 'returnTrackingId', 'items']
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderChangeOrderStateAction',
                ['action', 'orderState']
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderChangePaymentStateAction',
                ['action', 'paymentState']
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderChangeShipmentStateAction',
                ['action', 'shipmentState']
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderImportCustomLineItemStateAction',
                ['action', 'customLineItemId', 'state']
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderImportLineItemStateAction',
                ['action', 'lineItemId', 'state']
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderSetOrderNumberAction',
                ['action', 'orderNumber']
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderSetReturnPaymentStateAction',
                ['action', 'returnItemId', 'paymentState']
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderSetReturnShipmentStateAction',
                ['action', 'returnItemId', 'shipmentState']
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderTransitionCustomLineItemStateAction',
                ['action', 'customLineItemId', 'quantity', 'fromState', 'toState', 'actualTransitionDate']
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderTransitionLineItemStateAction',
                ['action', 'lineItemId', 'quantity', 'fromState', 'toState', 'actualTransitionDate']
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderUpdateSyncInfoAction',
                ['action', 'channel', 'externalId', 'syncedAt']
            ],
            [
                '\Sphere\Core\Request\Customers\Command\CustomerAddAddressAction',
                ['action', 'address']
            ],
            [
                '\Sphere\Core\Request\Customers\Command\CustomerChangeAddressAction',
                ['action', 'addressId', 'address']
            ],
            [
                '\Sphere\Core\Request\Customers\Command\CustomerChangeEmailAction',
                ['action', 'email']
            ],
            [
                '\Sphere\Core\Request\Customers\Command\CustomerChangeNameAction',
                ['action', 'firstName', 'lastName', 'middleName', 'title']
            ],
            [
                '\Sphere\Core\Request\Customers\Command\CustomerRemoveAddressAction',
                ['action', 'addressId']
            ],
            [
                '\Sphere\Core\Request\Customers\Command\CustomerSetCompanyNameAction',
                ['action', 'companyName']
            ],
            [
                '\Sphere\Core\Request\Customers\Command\CustomerSetCustomerGroupAction',
                ['action', 'customerGroup']
            ],
            [
                '\Sphere\Core\Request\Customers\Command\CustomerSetCustomerNumberAction',
                ['action', 'customerNumber']
            ],
            [
                '\Sphere\Core\Request\Customers\Command\CustomerSetDateOfBirthAction',
                ['action', 'dateOfBirth']
            ],
            [
                '\Sphere\Core\Request\Customers\Command\CustomerSetDefaultBillingAddressAction',
                ['action', 'addressId']
            ],
            [
                '\Sphere\Core\Request\Customers\Command\CustomerSetDefaultShippingAddressAction',
                ['action', 'addressId']
            ],
            [
                '\Sphere\Core\Request\Customers\Command\CustomerSetExternalIdAction',
                ['action', 'externalId']
            ],
            [
                '\Sphere\Core\Request\Customers\Command\CustomerSetVatIdAction',
                ['action', 'vatId']
            ],
            [
                '\Sphere\Core\Request\Categories\Command\CategoryChangeNameAction',
                ['action', 'name']
            ],
            [
                '\Sphere\Core\Request\Categories\Command\CategoryChangeOrderHintAction',
                ['action', 'orderHint']
            ],
            [
                '\Sphere\Core\Request\Categories\Command\CategoryChangeParentAction',
                ['action', 'parent']
            ],
            [
                '\Sphere\Core\Request\Categories\Command\CategoryChangeSlugAction',
                ['action', 'slug']
            ],
            [
                '\Sphere\Core\Request\Categories\Command\CategorySetDescriptionAction',
                ['action', 'description']
            ],
            [
                '\Sphere\Core\Request\Categories\Command\CategorySetExternalIdAction',
                ['action', 'externalId']
            ],
            [
                '\Sphere\Core\Request\Categories\Command\CategorySetMetaTitleAction',
                ['action', 'metaTitle']
            ],
            [
                '\Sphere\Core\Request\Categories\Command\CategorySetMetaDescriptionAction',
                ['action', 'metaDescription']
            ],
            [
                '\Sphere\Core\Request\Categories\Command\CategorySetMetaKeywordsAction',
                ['action', 'metaKeywords']
            ],
            [
                '\Sphere\Core\Request\Carts\Command\CartAddCustomLineItemAction',
                ['action', 'name', 'quantity', 'money', 'slug', 'taxCategory']
            ],
            [
                '\Sphere\Core\Request\Carts\Command\CartAddDiscountCodeAction',
                ['action', 'code']
            ],
            [
                '\Sphere\Core\Request\Carts\Command\CartAddLineItemAction',
                ['action', 'productId', 'variantId', 'quantity', 'supplyChannel', 'distributionChannel']
            ],
            [
                '\Sphere\Core\Request\Carts\Command\CartChangeLineItemQuantityAction',
                ['action', 'lineItemId', 'quantity']
            ],
            [
                '\Sphere\Core\Request\Carts\Command\CartRecalculateAction',
                ['action']
            ],
            [
                '\Sphere\Core\Request\Carts\Command\CartRemoveCustomLineItemAction',
                ['action', 'customLineItemId']
            ],
            [
                '\Sphere\Core\Request\Carts\Command\CartRemoveDiscountCodeAction',
                ['action', 'discountCode']
            ],
            [
                '\Sphere\Core\Request\Carts\Command\CartRemoveLineItemAction',
                ['action', 'lineItemId', 'quantity']
            ],
            [
                '\Sphere\Core\Request\Carts\Command\CartSetBillingAddressAction',
                ['action', 'address']
            ],
            [
                '\Sphere\Core\Request\Carts\Command\CartSetCountryAction',
                ['action', 'country']
            ],
            [
                '\Sphere\Core\Request\Carts\Command\CartSetCustomerEmailAction',
                ['action', 'email']
            ],
            [
                '\Sphere\Core\Request\Carts\Command\CartSetCustomerIdAction',
                ['action', 'customerId']
            ],
            [
                '\Sphere\Core\Request\Carts\Command\CartSetShippingAddressAction',
                ['action', 'address']
            ],
            [
                '\Sphere\Core\Request\Carts\Command\CartSetShippingMethodAction',
                ['action', 'shippingMethod']
            ],
            [
                '\Sphere\Core\Request\Carts\Command\CartSetCustomShippingMethodAction',
                ['action', 'shippingMethodName', 'shippingRate', 'taxCategory']
            ],
        ];
    }

    protected function getInstance($className)
    {
        $class = new \ReflectionClass($className);
        if (!$class->isAbstract()) {
            $object = $class->newInstanceWithoutConstructor();
        } else {
            $object = $this->getMockForAbstractClass($className, [], '', false);
        }

        return $object;
    }

    public function actionArgumentProvider()
    {
        return [
            [
                '\Sphere\Core\Request\AbstractAction',
                'of',
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductAddExternalImageAction',
                'ofVariantIdAndImage',
                [
                    10,
                    $this->getInstance('\Sphere\Core\Model\Common\Image')
                ]
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductAddPriceAction',
                'ofVariantIdAndPrice',
                [
                    10,
                    $this->getInstance('\Sphere\Core\Model\Common\Price')
                ]
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductAddToCategoryAction',
                'ofCategory',
                [
                    $this->getInstance('\Sphere\Core\Model\Category\CategoryReference')
                ]
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductAddVariantAction',
                'of',
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductChangeNameAction',
                'ofName',
                [
                    $this->getInstance('\Sphere\Core\Model\Common\LocalizedString')
                ]
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductChangePriceAction',
                'ofPriceIdAndPrice',
                [
                    10,
                    $this->getInstance('\Sphere\Core\Model\Common\Price')
                ]
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductChangeSlugAction',
                'ofSlug',
                [
                    $this->getInstance('\Sphere\Core\Model\Common\LocalizedString')
                ]
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductPublishAction',
                'of',
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductRemoveFromCategoryAction',
                'ofCategory',
                [
                    $this->getInstance('\Sphere\Core\Model\Category\CategoryReference')
                ]
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductRemoveImageAction',
                'ofVariantIdAndImageUrl',
                [10, 'imageUrl']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductRemovePriceAction',
                'ofPriceId',
                [
                    10
                ]
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductRemoveVariantAction',
                'ofVariantId',
                [10]
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductRevertStagedChangesAction',
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductSetAttributeAction',
                'ofVariantIdAndName',
                [10, 'attributeName']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductSetAttributeInAllVariantsAction',
                'ofName',
                ['attributeName']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductSetDescriptionAction',
                'ofDescription',
                [
                    $this->getInstance('\Sphere\Core\Model\Common\LocalizedString')
                ]
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductSetMetaAttributesAction',
                'of',
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductSetMetaTitleAction',
                'of',
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductSetMetaDescriptionAction',
                'of',
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductSetMetaKeywordsAction',
                'of',
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductSetSearchKeywordsAction',
                'ofKeywords',
                [
                    $this->getInstance('\Sphere\Core\Model\Product\LocalizedSearchKeywords')
                ]
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductSetSKUAction',
                'ofVariantId',
                [10]
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductSetTaxCategoryAction',
                'of',
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductUnpublishAction',
                'of',
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderAddDeliveryAction',
                'ofDeliveryItems',
                [
                    $this->getInstance('\Sphere\Core\Model\Order\DeliveryItemCollection')
                ]
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderAddParcelToDeliveryAction',
                'ofDeliveryId',
                ['1234567890']
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderAddReturnInfoAction',
                'of',
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderChangeOrderStateAction',
                'ofOrderState',
                ['newOrderState']
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderChangePaymentStateAction',
                'ofPaymentState',
                ['newPaymentState']
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderChangeShipmentStateAction',
                'ofShipmentState',
                ['newShipmentState']
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderImportCustomLineItemStateAction',
                'ofCustomLineItemIdAndState',
                [
                    '12345',
                    $this->getInstance('\Sphere\Core\Model\Order\ItemStateCollection')
                ]
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderImportLineItemStateAction',
                'ofLineItemIdAndState',
                [
                    '12345',
                    $this->getInstance('\Sphere\Core\Model\Order\ItemStateCollection')
                ]
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderSetOrderNumberAction',
                'of',
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderSetReturnPaymentStateAction',
                'ofReturnItemIdAndPaymentState',
                ['12345', 'paymentState']
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderSetReturnShipmentStateAction',
                'ofReturnItemIdAndShipmentState',
                ['12345', 'shipmentState']
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderTransitionCustomLineItemStateAction',
                'ofCustomLineItemIdQuantityAndFromToState',
                [
                    '12345',
                    2,
                    $this->getInstance('\Sphere\Core\Model\State\StateReference'),
                    $this->getInstance('\Sphere\Core\Model\State\StateReference'),
                ]
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderTransitionLineItemStateAction',
                'ofLineItemIdQuantityAndFromToState',
                [
                    '12345',
                    2,
                    $this->getInstance('\Sphere\Core\Model\State\StateReference'),
                    $this->getInstance('\Sphere\Core\Model\State\StateReference'),
                ]
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderUpdateSyncInfoAction',
                'ofChannel',
                [
                    $this->getInstance('\Sphere\Core\Model\Channel\ChannelReference')
                ]
            ],
            [
                '\Sphere\Core\Request\Customers\Command\CustomerAddAddressAction',
                'ofAddress',
                [
                    $this->getInstance('\Sphere\Core\Model\Common\Address')
                ]
            ],
            [
                '\Sphere\Core\Request\Customers\Command\CustomerChangeAddressAction',
                'ofAddressIdAndAddress',
                [
                    '1',
                    $this->getInstance('\Sphere\Core\Model\Common\Address')
                ]
            ],
            [
                '\Sphere\Core\Request\Customers\Command\CustomerChangeEmailAction',
                'ofEmail',
                ['john.doe@company.com']
            ],
            [
                '\Sphere\Core\Request\Customers\Command\CustomerChangeNameAction',
                'ofFirstNameAndLastName',
                ['John', 'Doe']
            ],
            [
                '\Sphere\Core\Request\Customers\Command\CustomerRemoveAddressAction',
                'ofAddressId',
                ['1']
            ],
            [
                '\Sphere\Core\Request\Customers\Command\CustomerSetCompanyNameAction',
                'of',
            ],
            [
                '\Sphere\Core\Request\Customers\Command\CustomerSetCustomerGroupAction',
                'of',
            ],
            [
                '\Sphere\Core\Request\Customers\Command\CustomerSetCustomerNumberAction',
                'of',
            ],
            [
                '\Sphere\Core\Request\Customers\Command\CustomerSetDateOfBirthAction',
                'of',
            ],
            [
                '\Sphere\Core\Request\Customers\Command\CustomerSetDefaultBillingAddressAction',
                'of',
            ],
            [
                '\Sphere\Core\Request\Customers\Command\CustomerSetDefaultShippingAddressAction',
                'of',
            ],
            [
                '\Sphere\Core\Request\Customers\Command\CustomerSetExternalIdAction',
                'of',
            ],
            [
                '\Sphere\Core\Request\Customers\Command\CustomerSetVatIdAction',
                'of',
            ],
            [
                '\Sphere\Core\Request\Categories\Command\CategoryChangeNameAction',
                'ofName',
                [
                    $this->getInstance('\Sphere\Core\Model\Common\LocalizedString')
                ]
            ],
            [
                '\Sphere\Core\Request\Categories\Command\CategoryChangeOrderHintAction',
                'ofOrderHint',
                ['orderHint']
            ],
            [
                '\Sphere\Core\Request\Categories\Command\CategoryChangeParentAction',
                'ofParentCategory',
                [
                    $this->getInstance('\Sphere\Core\Model\Category\CategoryReference')
                ]
            ],
            [
                '\Sphere\Core\Request\Categories\Command\CategoryChangeSlugAction',
                'ofSlug',
                [
                    $this->getInstance('\Sphere\Core\Model\Common\LocalizedString')
                ]
            ],
            [
                '\Sphere\Core\Request\Categories\Command\CategorySetDescriptionAction',
                'ofDescription',
                [
                    $this->getInstance('\Sphere\Core\Model\Common\LocalizedString')
                ]
            ],
            [
                '\Sphere\Core\Request\Categories\Command\CategorySetExternalIdAction',
                'ofExternalId',
                ['externalId']
            ],
            [
                '\Sphere\Core\Request\Categories\Command\CategorySetMetaTitleAction',
                'of',
            ],
            [
                '\Sphere\Core\Request\Categories\Command\CategorySetMetaDescriptionAction',
                'of',
            ],
            [
                '\Sphere\Core\Request\Categories\Command\CategorySetMetaKeywordsAction',
                'of',
            ],
            [
                '\Sphere\Core\Request\Carts\Command\CartAddCustomLineItemAction',
                'ofNameQuantityMoneySlugAndTaxCategory',
                [
                    $this->getInstance('\Sphere\Core\Model\Common\LocalizedString'),
                    10,
                    $this->getInstance('\Sphere\Core\Model\Common\Money'),
                    'my-custom-line-item',
                    $this->getInstance('\Sphere\Core\Model\TaxCategory\TaxCategory')
                ]
            ],
            [
                '\Sphere\Core\Request\Carts\Command\CartAddDiscountCodeAction',
                'ofCode',
                ['code']
            ],
            [
                '\Sphere\Core\Request\Carts\Command\CartAddLineItemAction',
                'ofProductIdVariantIdAndQuantity',
                ['productId', 1, 2]
            ],
            [
                '\Sphere\Core\Request\Carts\Command\CartChangeLineItemQuantityAction',
                'ofLineItemIdAndQuantity',
                ['lineItemId', 3]
            ],
            [
                '\Sphere\Core\Request\Carts\Command\CartRecalculateAction',
                'of',
            ],
            [
                '\Sphere\Core\Request\Carts\Command\CartRemoveCustomLineItemAction',
                'ofCustomLineItemId',
                ['customLineItemId']
            ],
            [
                '\Sphere\Core\Request\Carts\Command\CartRemoveDiscountCodeAction',
                'ofDiscountCode',
                [
                    $this->getInstance('\Sphere\Core\Model\DiscountCode\DiscountCodeReference')
                ]
            ],
            [
                '\Sphere\Core\Request\Carts\Command\CartRemoveLineItemAction',
                'ofLineItemId',
                ['lineItemId', 1]
            ],
            [
                '\Sphere\Core\Request\Carts\Command\CartSetBillingAddressAction',
                'of',
            ],
            [
                '\Sphere\Core\Request\Carts\Command\CartSetCountryAction',
                'of',
            ],
            [
                '\Sphere\Core\Request\Carts\Command\CartSetCustomerEmailAction',
                'of',
            ],
            [
                '\Sphere\Core\Request\Carts\Command\CartSetCustomerIdAction',
                'of',
            ],
            [
                '\Sphere\Core\Request\Carts\Command\CartSetShippingAddressAction',
                'of',
            ],
            [
                '\Sphere\Core\Request\Carts\Command\CartSetShippingMethodAction',
                'of',
            ],
            [
                '\Sphere\Core\Request\Carts\Command\CartSetCustomShippingMethodAction',
                'of',
            ],
        ];
    }

    /**
     * @dataProvider actionFieldProvider
     * @param string $className
     * @param array $validFields
     */
    public function testValidProperties($className, array $validFields = [])
    {
        $object = $this->getInstance($className);

        $validFields = array_flip($validFields);
        foreach ($object->getFields() as $fieldKey => $field) {
            $this->assertArrayHasKey(
                $fieldKey,
                $validFields,
                sprintf('Failed asserting that \'%s\' is a valid field at \'%s\'', $fieldKey, $className)
            );
        }
    }

    /**
     * @dataProvider actionFieldProvider
     * @param string $className
     * @param array $validFields
     */
    public function testPropertiesExist($className, array $validFields = [])
    {
        $object = $this->getInstance($className);

        foreach ($validFields as $fieldKey) {
            $this->assertArrayHasKey(
                $fieldKey,
                $object->getFields(),
                sprintf('Failed asserting that \'%s\' has a field \'%s\'', $className, $fieldKey)
            );
        }
    }

    /**
     * @dataProvider actionArgumentProvider
     * @param $className
     * @param $constructor
     * @param array $args
     */
    public function testConstruct($className, $constructor = 'of', array $args = [])
    {
        $class = new \ReflectionClass($className);
        if (!$class->isAbstract()) {
            $object = call_user_func_array($className . '::' . $constructor, $args);
        } else {
            $object = $this->getMockForAbstractClass($className, $args);
        }

        $this->assertInstanceOf($className, $object);
    }
}
