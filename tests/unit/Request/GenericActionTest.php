<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request;


use Commercetools\Core\Model\Common\LocalizedString;

class GenericActionTest extends \PHPUnit_Framework_TestCase
{
    public function actionFieldProvider()
    {
        return [
            [
                '\Commercetools\Core\Request\AbstractAction',
                ['action']
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductAddExternalImageAction',
                ['action', 'variantId', 'image', 'staged']
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductAddPriceAction',
                ['action', 'variantId', 'price', 'staged']
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductAddToCategoryAction',
                ['action', 'category', 'staged']
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductAddVariantAction',
                ['action', 'prices', 'sku', 'attributes', 'staged']
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductChangeNameAction',
                ['action', 'name', 'staged']
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductChangePriceAction',
                ['action', 'priceId', 'price', 'staged']
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductChangeSlugAction',
                ['action', 'slug', 'staged']
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductPublishAction',
                ['action']
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductRemoveFromCategoryAction',
                ['action', 'category', 'staged']
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductRemoveImageAction',
                ['action', 'variantId', 'imageUrl', 'staged']
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductRemovePriceAction',
                ['action', 'priceId', 'staged']
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductRemoveVariantAction',
                ['action', 'id', 'staged']
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductRevertStagedChangesAction',
                ['action']
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductSetAttributeAction',
                ['action', 'variantId', 'name', 'value', 'staged']
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductSetAttributeInAllVariantsAction',
                ['action', 'name', 'value', 'staged']
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductSetDescriptionAction',
                ['action', 'description', 'staged']
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductSetMetaAttributesAction',
                ['action', 'metaTitle', 'metaDescription', 'metaKeywords', 'staged']
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductSetMetaTitleAction',
                ['action', 'metaTitle']
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductSetMetaDescriptionAction',
                ['action', 'metaDescription']
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductSetMetaKeywordsAction',
                ['action', 'metaKeywords']
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductSetSearchKeywordsAction',
                ['action', 'searchKeywords', 'staged']
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductSetSKUAction',
                ['action', 'variantId', 'sku']
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductSetTaxCategoryAction',
                ['action', 'taxCategory', 'staged']
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductUnpublishAction',
                ['action']
            ],
            [
                '\Commercetools\Core\Request\Orders\Command\OrderAddDeliveryAction',
                ['action', 'items', 'parcels', 'measurements', 'trackingData']
            ],
            [
                '\Commercetools\Core\Request\Orders\Command\OrderAddParcelToDeliveryAction',
                ['action', 'deliveryId', 'measurements', 'trackingData']
            ],
            [
                '\Commercetools\Core\Request\Orders\Command\OrderAddReturnInfoAction',
                ['action', 'returnDate', 'returnTrackingId', 'items']
            ],
            [
                '\Commercetools\Core\Request\Orders\Command\OrderChangeOrderStateAction',
                ['action', 'orderState']
            ],
            [
                '\Commercetools\Core\Request\Orders\Command\OrderChangePaymentStateAction',
                ['action', 'paymentState']
            ],
            [
                '\Commercetools\Core\Request\Orders\Command\OrderChangeShipmentStateAction',
                ['action', 'shipmentState']
            ],
            [
                '\Commercetools\Core\Request\Orders\Command\OrderImportCustomLineItemStateAction',
                ['action', 'customLineItemId', 'state']
            ],
            [
                '\Commercetools\Core\Request\Orders\Command\OrderImportLineItemStateAction',
                ['action', 'lineItemId', 'state']
            ],
            [
                '\Commercetools\Core\Request\Orders\Command\OrderSetOrderNumberAction',
                ['action', 'orderNumber']
            ],
            [
                '\Commercetools\Core\Request\Orders\Command\OrderSetReturnPaymentStateAction',
                ['action', 'returnItemId', 'paymentState']
            ],
            [
                '\Commercetools\Core\Request\Orders\Command\OrderSetReturnShipmentStateAction',
                ['action', 'returnItemId', 'shipmentState']
            ],
            [
                '\Commercetools\Core\Request\Orders\Command\OrderTransitionCustomLineItemStateAction',
                ['action', 'customLineItemId', 'quantity', 'fromState', 'toState', 'actualTransitionDate']
            ],
            [
                '\Commercetools\Core\Request\Orders\Command\OrderTransitionLineItemStateAction',
                ['action', 'lineItemId', 'quantity', 'fromState', 'toState', 'actualTransitionDate']
            ],
            [
                '\Commercetools\Core\Request\Orders\Command\OrderUpdateSyncInfoAction',
                ['action', 'channel', 'externalId', 'syncedAt']
            ],
            [
                '\Commercetools\Core\Request\Customers\Command\CustomerAddAddressAction',
                ['action', 'address']
            ],
            [
                '\Commercetools\Core\Request\Customers\Command\CustomerChangeAddressAction',
                ['action', 'addressId', 'address']
            ],
            [
                '\Commercetools\Core\Request\Customers\Command\CustomerChangeEmailAction',
                ['action', 'email']
            ],
            [
                '\Commercetools\Core\Request\Customers\Command\CustomerChangeNameAction',
                ['action', 'firstName', 'lastName', 'middleName', 'title']
            ],
            [
                '\Commercetools\Core\Request\Customers\Command\CustomerRemoveAddressAction',
                ['action', 'addressId']
            ],
            [
                '\Commercetools\Core\Request\Customers\Command\CustomerSetCompanyNameAction',
                ['action', 'companyName']
            ],
            [
                '\Commercetools\Core\Request\Customers\Command\CustomerSetCustomerGroupAction',
                ['action', 'customerGroup']
            ],
            [
                '\Commercetools\Core\Request\Customers\Command\CustomerSetCustomerNumberAction',
                ['action', 'customerNumber']
            ],
            [
                '\Commercetools\Core\Request\Customers\Command\CustomerSetDateOfBirthAction',
                ['action', 'dateOfBirth']
            ],
            [
                '\Commercetools\Core\Request\Customers\Command\CustomerSetDefaultBillingAddressAction',
                ['action', 'addressId']
            ],
            [
                '\Commercetools\Core\Request\Customers\Command\CustomerSetDefaultShippingAddressAction',
                ['action', 'addressId']
            ],
            [
                '\Commercetools\Core\Request\Customers\Command\CustomerSetExternalIdAction',
                ['action', 'externalId']
            ],
            [
                '\Commercetools\Core\Request\Customers\Command\CustomerSetVatIdAction',
                ['action', 'vatId']
            ],
            [
                '\Commercetools\Core\Request\Categories\Command\CategoryChangeNameAction',
                ['action', 'name']
            ],
            [
                '\Commercetools\Core\Request\Categories\Command\CategoryChangeOrderHintAction',
                ['action', 'orderHint']
            ],
            [
                '\Commercetools\Core\Request\Categories\Command\CategoryChangeParentAction',
                ['action', 'parent']
            ],
            [
                '\Commercetools\Core\Request\Categories\Command\CategoryChangeSlugAction',
                ['action', 'slug']
            ],
            [
                '\Commercetools\Core\Request\Categories\Command\CategorySetDescriptionAction',
                ['action', 'description']
            ],
            [
                '\Commercetools\Core\Request\Categories\Command\CategorySetExternalIdAction',
                ['action', 'externalId']
            ],
            [
                '\Commercetools\Core\Request\Categories\Command\CategorySetMetaTitleAction',
                ['action', 'metaTitle']
            ],
            [
                '\Commercetools\Core\Request\Categories\Command\CategorySetMetaDescriptionAction',
                ['action', 'metaDescription']
            ],
            [
                '\Commercetools\Core\Request\Categories\Command\CategorySetMetaKeywordsAction',
                ['action', 'metaKeywords']
            ],
            [
                '\Commercetools\Core\Request\Carts\Command\CartAddCustomLineItemAction',
                ['action', 'name', 'quantity', 'money', 'slug', 'taxCategory', 'custom']
            ],
            [
                '\Commercetools\Core\Request\Carts\Command\CartAddDiscountCodeAction',
                ['action', 'code']
            ],
            [
                '\Commercetools\Core\Request\Carts\Command\CartAddLineItemAction',
                ['action', 'productId', 'variantId', 'quantity', 'supplyChannel', 'distributionChannel', 'custom']
            ],
            [
                '\Commercetools\Core\Request\Carts\Command\CartChangeLineItemQuantityAction',
                ['action', 'lineItemId', 'quantity']
            ],
            [
                '\Commercetools\Core\Request\Carts\Command\CartRecalculateAction',
                ['action']
            ],
            [
                '\Commercetools\Core\Request\Carts\Command\CartRemoveCustomLineItemAction',
                ['action', 'customLineItemId']
            ],
            [
                '\Commercetools\Core\Request\Carts\Command\CartRemoveDiscountCodeAction',
                ['action', 'discountCode']
            ],
            [
                '\Commercetools\Core\Request\Carts\Command\CartRemoveLineItemAction',
                ['action', 'lineItemId', 'quantity']
            ],
            [
                '\Commercetools\Core\Request\Carts\Command\CartSetBillingAddressAction',
                ['action', 'address']
            ],
            [
                '\Commercetools\Core\Request\Carts\Command\CartSetCountryAction',
                ['action', 'country']
            ],
            [
                '\Commercetools\Core\Request\Carts\Command\CartSetCustomerEmailAction',
                ['action', 'email']
            ],
            [
                '\Commercetools\Core\Request\Carts\Command\CartSetCustomerIdAction',
                ['action', 'customerId']
            ],
            [
                '\Commercetools\Core\Request\Carts\Command\CartSetShippingAddressAction',
                ['action', 'address']
            ],
            [
                '\Commercetools\Core\Request\Carts\Command\CartSetShippingMethodAction',
                ['action', 'shippingMethod']
            ],
            [
                '\Commercetools\Core\Request\Carts\Command\CartSetCustomShippingMethodAction',
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
                '\Commercetools\Core\Request\AbstractAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductAddExternalImageAction',
                'ofVariantIdAndImage',
                [
                    10,
                    $this->getInstance('\Commercetools\Core\Model\Common\Image')
                ]
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductAddPriceAction',
                'ofVariantIdAndPrice',
                [
                    10,
                    $this->getInstance('\Commercetools\Core\Model\Common\Price')
                ]
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductAddToCategoryAction',
                'ofCategory',
                [
                    $this->getInstance('\Commercetools\Core\Model\Category\CategoryReference')
                ]
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductAddVariantAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductChangeNameAction',
                'ofName',
                [
                    $this->getInstance('\Commercetools\Core\Model\Common\LocalizedString')
                ]
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductChangePriceAction',
                'ofPriceIdAndPrice',
                [
                    10,
                    $this->getInstance('\Commercetools\Core\Model\Common\Price')
                ]
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductChangeSlugAction',
                'ofSlug',
                [
                    $this->getInstance('\Commercetools\Core\Model\Common\LocalizedString')
                ]
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductPublishAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductRemoveFromCategoryAction',
                'ofCategory',
                [
                    $this->getInstance('\Commercetools\Core\Model\Category\CategoryReference')
                ]
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductRemoveImageAction',
                'ofVariantIdAndImageUrl',
                [10, 'imageUrl']
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductRemovePriceAction',
                'ofPriceId',
                [
                    '10'
                ]
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductRemoveVariantAction',
                'ofVariantId',
                [10]
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductRevertStagedChangesAction',
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductSetAttributeAction',
                'ofVariantIdAndName',
                [10, 'attributeName']
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductSetAttributeInAllVariantsAction',
                'ofName',
                ['attributeName']
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductSetDescriptionAction',
                'ofDescription',
                [
                    $this->getInstance('\Commercetools\Core\Model\Common\LocalizedString')
                ]
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductSetMetaAttributesAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductSetMetaTitleAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductSetMetaDescriptionAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductSetMetaKeywordsAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductSetSearchKeywordsAction',
                'ofKeywords',
                [
                    $this->getInstance('\Commercetools\Core\Model\Product\LocalizedSearchKeywords')
                ]
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductSetSKUAction',
                'ofVariantId',
                [10]
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductSetTaxCategoryAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductUnpublishAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Orders\Command\OrderAddDeliveryAction',
                'ofDeliveryItems',
                [
                    $this->getInstance('\Commercetools\Core\Model\Order\DeliveryItemCollection')
                ]
            ],
            [
                '\Commercetools\Core\Request\Orders\Command\OrderAddParcelToDeliveryAction',
                'ofDeliveryId',
                ['1234567890']
            ],
            [
                '\Commercetools\Core\Request\Orders\Command\OrderAddReturnInfoAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Orders\Command\OrderChangeOrderStateAction',
                'ofOrderState',
                ['newOrderState']
            ],
            [
                '\Commercetools\Core\Request\Orders\Command\OrderChangePaymentStateAction',
                'ofPaymentState',
                ['newPaymentState']
            ],
            [
                '\Commercetools\Core\Request\Orders\Command\OrderChangeShipmentStateAction',
                'ofShipmentState',
                ['newShipmentState']
            ],
            [
                '\Commercetools\Core\Request\Orders\Command\OrderImportCustomLineItemStateAction',
                'ofCustomLineItemIdAndState',
                [
                    '12345',
                    $this->getInstance('\Commercetools\Core\Model\Order\ItemStateCollection')
                ]
            ],
            [
                '\Commercetools\Core\Request\Orders\Command\OrderImportLineItemStateAction',
                'ofLineItemIdAndState',
                [
                    '12345',
                    $this->getInstance('\Commercetools\Core\Model\Order\ItemStateCollection')
                ]
            ],
            [
                '\Commercetools\Core\Request\Orders\Command\OrderSetOrderNumberAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Orders\Command\OrderSetReturnPaymentStateAction',
                'ofReturnItemIdAndPaymentState',
                ['12345', 'paymentState']
            ],
            [
                '\Commercetools\Core\Request\Orders\Command\OrderSetReturnShipmentStateAction',
                'ofReturnItemIdAndShipmentState',
                ['12345', 'shipmentState']
            ],
            [
                '\Commercetools\Core\Request\Orders\Command\OrderTransitionCustomLineItemStateAction',
                'ofCustomLineItemIdQuantityAndFromToState',
                [
                    '12345',
                    2,
                    $this->getInstance('\Commercetools\Core\Model\State\StateReference'),
                    $this->getInstance('\Commercetools\Core\Model\State\StateReference'),
                ]
            ],
            [
                '\Commercetools\Core\Request\Orders\Command\OrderTransitionLineItemStateAction',
                'ofLineItemIdQuantityAndFromToState',
                [
                    '12345',
                    2,
                    $this->getInstance('\Commercetools\Core\Model\State\StateReference'),
                    $this->getInstance('\Commercetools\Core\Model\State\StateReference'),
                ]
            ],
            [
                '\Commercetools\Core\Request\Orders\Command\OrderUpdateSyncInfoAction',
                'ofChannel',
                [
                    $this->getInstance('\Commercetools\Core\Model\Channel\ChannelReference')
                ]
            ],
            [
                '\Commercetools\Core\Request\Customers\Command\CustomerAddAddressAction',
                'ofAddress',
                [
                    $this->getInstance('\Commercetools\Core\Model\Common\Address')
                ]
            ],
            [
                '\Commercetools\Core\Request\Customers\Command\CustomerChangeAddressAction',
                'ofAddressIdAndAddress',
                [
                    '1',
                    $this->getInstance('\Commercetools\Core\Model\Common\Address')
                ]
            ],
            [
                '\Commercetools\Core\Request\Customers\Command\CustomerChangeEmailAction',
                'ofEmail',
                ['john.doe@company.com']
            ],
            [
                '\Commercetools\Core\Request\Customers\Command\CustomerChangeNameAction',
                'ofFirstNameAndLastName',
                ['John', 'Doe']
            ],
            [
                '\Commercetools\Core\Request\Customers\Command\CustomerRemoveAddressAction',
                'ofAddressId',
                ['1']
            ],
            [
                '\Commercetools\Core\Request\Customers\Command\CustomerSetCompanyNameAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Customers\Command\CustomerSetCustomerGroupAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Customers\Command\CustomerSetCustomerNumberAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Customers\Command\CustomerSetDateOfBirthAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Customers\Command\CustomerSetDefaultBillingAddressAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Customers\Command\CustomerSetDefaultShippingAddressAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Customers\Command\CustomerSetExternalIdAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Customers\Command\CustomerSetVatIdAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Categories\Command\CategoryChangeNameAction',
                'ofName',
                [
                    $this->getInstance('\Commercetools\Core\Model\Common\LocalizedString')
                ]
            ],
            [
                '\Commercetools\Core\Request\Categories\Command\CategoryChangeOrderHintAction',
                'ofOrderHint',
                ['orderHint']
            ],
            [
                '\Commercetools\Core\Request\Categories\Command\CategoryChangeParentAction',
                'ofParentCategory',
                [
                    $this->getInstance('\Commercetools\Core\Model\Category\CategoryReference')
                ]
            ],
            [
                '\Commercetools\Core\Request\Categories\Command\CategoryChangeSlugAction',
                'ofSlug',
                [
                    $this->getInstance('\Commercetools\Core\Model\Common\LocalizedString')
                ]
            ],
            [
                '\Commercetools\Core\Request\Categories\Command\CategorySetDescriptionAction',
                'ofDescription',
                [
                    $this->getInstance('\Commercetools\Core\Model\Common\LocalizedString')
                ]
            ],
            [
                '\Commercetools\Core\Request\Categories\Command\CategorySetExternalIdAction',
                'ofExternalId',
                ['externalId']
            ],
            [
                '\Commercetools\Core\Request\Categories\Command\CategorySetMetaTitleAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Categories\Command\CategorySetMetaDescriptionAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Categories\Command\CategorySetMetaKeywordsAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Carts\Command\CartAddCustomLineItemAction',
                'ofNameQuantityMoneySlugAndTaxCategory',
                [
                    $this->getInstance('\Commercetools\Core\Model\Common\LocalizedString'),
                    10,
                    $this->getInstance('\Commercetools\Core\Model\Common\Money'),
                    'my-custom-line-item',
                    $this->getInstance('\Commercetools\Core\Model\TaxCategory\TaxCategoryReference')
                ]
            ],
            [
                '\Commercetools\Core\Request\Carts\Command\CartAddDiscountCodeAction',
                'ofCode',
                ['code']
            ],
            [
                '\Commercetools\Core\Request\Carts\Command\CartAddLineItemAction',
                'ofProductIdVariantIdAndQuantity',
                ['productId', 1, 2]
            ],
            [
                '\Commercetools\Core\Request\Carts\Command\CartChangeLineItemQuantityAction',
                'ofLineItemIdAndQuantity',
                ['lineItemId', 3]
            ],
            [
                '\Commercetools\Core\Request\Carts\Command\CartRecalculateAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Carts\Command\CartRemoveCustomLineItemAction',
                'ofCustomLineItemId',
                ['customLineItemId']
            ],
            [
                '\Commercetools\Core\Request\Carts\Command\CartRemoveDiscountCodeAction',
                'ofDiscountCode',
                [
                    $this->getInstance('\Commercetools\Core\Model\DiscountCode\DiscountCodeReference')
                ]
            ],
            [
                '\Commercetools\Core\Request\Carts\Command\CartRemoveLineItemAction',
                'ofLineItemId',
                ['lineItemId', 1]
            ],
            [
                '\Commercetools\Core\Request\Carts\Command\CartSetBillingAddressAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Carts\Command\CartSetCountryAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Carts\Command\CartSetCustomerEmailAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Carts\Command\CartSetCustomerIdAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Carts\Command\CartSetShippingAddressAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Carts\Command\CartSetShippingMethodAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Carts\Command\CartSetCustomShippingMethodAction',
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
        foreach ($object->fieldDefinitions() as $fieldKey => $field) {
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
                $object->fieldDefinitions(),
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
