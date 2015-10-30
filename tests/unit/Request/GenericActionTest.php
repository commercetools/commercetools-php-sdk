<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\Model\Channel\ChannelRole;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Type\TypeReference;

class GenericActionTest extends \PHPUnit_Framework_TestCase
{
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
                '\Commercetools\Core\Request\Products\Command\ProductSetPriceCustomFieldAction',
                ['action', 'priceId', 'staged', 'name', 'value'],
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductSetPriceCustomTypeAction',
                ['action', 'typeId', 'typeKey', 'priceId', 'staged', 'fields'],
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
            [
                '\Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeCartPredicateAction',
                ['action', 'cartPredicate']
            ],
            [
                '\Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeIsActiveAction',
                ['action', 'isActive']
            ],
            [
                '\Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeNameAction',
                ['action', 'name']
            ],
            [
                '\Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeRequiresDiscountCodeAction',
                ['action', 'requiresDiscountCode']
            ],
            [
                '\Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeSortOrderAction',
                ['action', 'sortOrder']
            ],
            [
                '\Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeTargetAction',
                ['action', 'target']
            ],
            [
                '\Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeValueAction',
                ['action', 'value']
            ],
            [
                '\Commercetools\Core\Request\CartDiscounts\Command\CartDiscountSetDescriptionAction',
                ['action', 'description']
            ],
            [
                '\Commercetools\Core\Request\CartDiscounts\Command\CartDiscountSetValidFromAction',
                ['action', 'validFrom']
            ],
            [
                '\Commercetools\Core\Request\CartDiscounts\Command\CartDiscountSetValidUntilAction',
                ['action', 'validUntil']
            ],
            [
                '\Commercetools\Core\Request\Channels\Command\ChannelAddRolesAction',
                ['action', 'roles']
            ],
            [
                '\Commercetools\Core\Request\Channels\Command\ChannelChangeDescriptionAction',
                ['action', 'description']
            ],
            [
                '\Commercetools\Core\Request\Channels\Command\ChannelChangeKeyAction',
                ['action', 'key']
            ],
            [
                '\Commercetools\Core\Request\Channels\Command\ChannelChangeNameAction',
                ['action', 'name']
            ],
            [
                '\Commercetools\Core\Request\Channels\Command\ChannelRemoveRolesAction',
                ['action', 'roles']
            ],
            [
                '\Commercetools\Core\Request\Channels\Command\ChannelSetRolesAction',
                ['action', 'roles']
            ],
            [
                '\Commercetools\Core\Request\CustomerGroups\Command\CustomerGroupChangeNameAction',
                ['action', 'name']
            ],
            [
                '\Commercetools\Core\Request\CustomField\Command\SetCustomFieldAction',
                ['action', 'name', 'value']
            ],
            [
                '\Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction',
                ['action', 'typeId', 'typeKey', 'fields']
            ],
            [
                '\Commercetools\Core\Request\Zones\Command\ZoneAddLocationAction',
                ['action', 'location']
            ],
            [
                '\Commercetools\Core\Request\Zones\Command\ZoneChangeNameAction',
                ['action', 'name']
            ],
            [
                '\Commercetools\Core\Request\Zones\Command\ZoneRemoveLocationAction',
                ['action', 'location']
            ],
            [
                '\Commercetools\Core\Request\Zones\Command\ZoneSetDescriptionAction',
                ['action', 'description']
            ],
            [
                '\Commercetools\Core\Request\TaxCategories\Command\TaxCategoryAddTaxRateAction',
                ['action', 'taxRate']
            ],
            [
                '\Commercetools\Core\Request\TaxCategories\Command\TaxCategoryChangeNameAction',
                ['action', 'name']
            ],
            [
                '\Commercetools\Core\Request\TaxCategories\Command\TaxCategoryRemoveTaxRateAction',
                ['action', 'rateId']
            ],
            [
                '\Commercetools\Core\Request\TaxCategories\Command\TaxCategoryReplaceTaxRateAction',
                ['action', 'taxRateId', 'taxRate']
            ],
            [
                '\Commercetools\Core\Request\TaxCategories\Command\TaxCategorySetDescriptionAction',
                ['action', 'description']
            ],
            [
                '\Commercetools\Core\Request\Reviews\Command\ReviewSetAuthorNameAction',
                ['action', 'authorName']
            ],
            [
                '\Commercetools\Core\Request\Reviews\Command\ReviewSetScoreAction',
                ['action', 'score']
            ],
            [
                '\Commercetools\Core\Request\Reviews\Command\ReviewSetTextAction',
                ['action', 'text']
            ],
            [
                '\Commercetools\Core\Request\Reviews\Command\ReviewSetTitleAction',
                ['action', 'title']
            ],
            [
                '\Commercetools\Core\Request\Reviews\Command\ReviewTransitionStateAction',
                ['action', 'state']
            ],
            [
                '\Commercetools\Core\Request\Types\Command\TypeAddEnumValueAction',
                ['action', 'fieldName', 'value']
            ],
            [
                '\Commercetools\Core\Request\Types\Command\TypeAddFieldDefinitionAction',
                ['action', 'fieldDefinition']
            ],
            [
                '\Commercetools\Core\Request\Types\Command\TypeAddLocalizedEnumValueAction',
                ['action', 'fieldName', 'value']
            ],
            [
                '\Commercetools\Core\Request\Types\Command\TypeChangeEnumValueOrderAction',
                ['action', 'fieldName', 'keys']
            ],
            [
                '\Commercetools\Core\Request\Types\Command\TypeChangeFieldDefinitionOrderAction',
                ['action', 'fieldNames']
            ],
            [
                '\Commercetools\Core\Request\Types\Command\TypeChangeLabelAction',
                ['action', 'fieldName', 'label']
            ],
            [
                '\Commercetools\Core\Request\Types\Command\TypeChangeLocalizedEnumValueOrderAction',
                ['action', 'fieldName', 'keys']
            ],
            [
                '\Commercetools\Core\Request\Types\Command\TypeChangeNameAction',
                ['action', 'name']
            ],
            [
                '\Commercetools\Core\Request\Types\Command\TypeRemoveFieldDefinitionAction',
                ['action', 'fieldName']
            ],
            [
                '\Commercetools\Core\Request\Types\Command\TypeSetDescriptionAction',
                ['action', 'description']
            ],
            [
                '\Commercetools\Core\Request\States\Command\StateChangeInitialAction',
                ['action', 'initial']
            ],
            [
                '\Commercetools\Core\Request\States\Command\StateChangeKeyAction',
                ['action', 'key']
            ],
            [
                '\Commercetools\Core\Request\States\Command\StateChangeTypeAction',
                ['action', 'type']
            ],
            [
                '\Commercetools\Core\Request\States\Command\StateSetDescriptionAction',
                ['action', 'description']
            ],
            [
                '\Commercetools\Core\Request\States\Command\StateSetNameAction',
                ['action', 'name']
            ],
            [
                '\Commercetools\Core\Request\States\Command\StateSetTransitionsAction',
                ['action', 'transitions']
            ],
            [
                '\Commercetools\Core\Request\States\Command\TransitionStateAction',
                ['action', 'state']
            ],
            [
                '\Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeChangeCartDiscountsAction',
                ['action', 'cartDiscounts']
            ],
            [
                '\Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeChangeIsActiveAction',
                ['action', 'isActive']
            ],
            [
                '\Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetCartPredicateAction',
                ['action', 'cartPredicate']
            ],
            [
                '\Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetDescriptionAction',
                ['action', 'description']
            ],
            [
                '\Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetMaxApplicationsAction',
                ['action', 'maxApplications']
            ],
            [
                '\Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetMaxApplicationsPerCustomerAction',
                ['action', 'maxApplicationsPerCustomer']
            ],
            [
                '\Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetNameAction',
                ['action', 'name']
            ],
            [
                '\Commercetools\Core\Request\Inventory\Command\InventoryAddQuantityAction',
                ['action', 'quantity']
            ],
            [
                '\Commercetools\Core\Request\Inventory\Command\InventoryChangeQuantityAction',
                ['action', 'quantity']
            ],
            [
                '\Commercetools\Core\Request\Inventory\Command\InventoryRemoveQuantityAction',
                ['action', 'quantity']
            ],
            [
                '\Commercetools\Core\Request\Inventory\Command\InventorySetExpectedDeliveryAction',
                ['action', 'expectedDelivery']
            ],
            [
                '\Commercetools\Core\Request\Inventory\Command\InventorySetRestockableInDaysAction',
                ['action', 'restockableInDays']
            ],
            [
                '\Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountChangeIsActiveAction',
                ['action', 'isActive']
            ],
            [
                '\Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountChangeNameAction',
                ['action', 'name']
            ],
            [
                '\Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountChangePredicateAction',
                ['action', 'predicate']
            ],
            [
                '\Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountChangeSortOrderAction',
                ['action', 'sortOrder']
            ],
            [
                '\Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountChangeValueAction',
                ['action', 'value']
            ],
            [
                '\Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountSetDescriptionAction',
                ['action', 'description']
            ],
            [
                '\Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodAddShippingRateAction',
                ['action', 'zone', 'shippingRate']
            ],
            [
                '\Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodAddZoneAction',
                ['action', 'zone']
            ],
            [
                '\Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodChangeIsDefaultAction',
                ['action', 'isDefault']
            ],
            [
                '\Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodChangeNameAction',
                ['action', 'name']
            ],
            [
                '\Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodChangeTaxCategoryAction',
                ['action', 'taxCategory']
            ],
            [
                '\Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodRemoveShippingRateAction',
                ['action', 'zone', 'shippingRate']
            ],
            [
                '\Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodRemoveZoneAction',
                ['action', 'zone']
            ],
            [
                '\Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodSetDescriptionAction',
                ['action', 'description']
            ],
            [
                '\Commercetools\Core\Request\ProductTypes\Command\ProductTypeAddAttributeDefinitionAction',
                ['action', 'attribute']
            ],
            [
                '\Commercetools\Core\Request\ProductTypes\Command\ProductTypeAddLocalizedEnumValueAction',
                ['action', 'attributeName', 'value']
            ],
            [
                '\Commercetools\Core\Request\ProductTypes\Command\ProductTypeAddPlainEnumValueAction',
                ['action', 'attributeName', 'value']
            ],
            [
                '\Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeAttributeOrderAction',
                ['action', 'attributes']
            ],
            [
                '\Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeDescriptionAction',
                ['action', 'description']
            ],
            [
                '\Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeLabelAction',
                ['action', 'attributeName', 'label']
            ],
            [
                '\Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeLocalizedEnumValueOrderAction',
                ['action', 'attributeName', 'values']
            ],
            [
                '\Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeNameAction',
                ['action', 'name']
            ],
            [
                '\Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangePlainEnumValueOrderAction',
                ['action', 'attributeName', 'values']
            ],
            [
                '\Commercetools\Core\Request\ProductTypes\Command\ProductTypeRemoveAttributeDefinitionAction',
                ['action', 'name']
            ],
            [
                '\Commercetools\Core\Request\Payments\Command\PaymentAddInterfaceInteractionAction',
                ['action', 'typeId', 'typeKey', 'fields']
            ],
            [
                '\Commercetools\Core\Request\Payments\Command\PaymentAddTransactionAction',
                ['action', 'transaction']
            ],
            [
                '\Commercetools\Core\Request\Payments\Command\PaymentSetAmountPaidAction',
                ['action', 'amount']
            ],
            [
                '\Commercetools\Core\Request\Payments\Command\PaymentSetAmountRefundedAction',
                ['action', 'amount']
            ],
            [
                '\Commercetools\Core\Request\Payments\Command\PaymentSetAuthorizationAction',
                ['action', 'amount', 'until']
            ],
            [
                '\Commercetools\Core\Request\Payments\Command\PaymentSetCustomerAction',
                ['action', 'customer']
            ],
            [
                '\Commercetools\Core\Request\Payments\Command\PaymentSetCustomFieldAction',
                ['action', 'name', 'value']
            ],
            [
                '\Commercetools\Core\Request\Payments\Command\PaymentSetCustomTypeAction',
                ['action', 'typeId', 'typeKey', 'fields']
            ],
            [
                '\Commercetools\Core\Request\Payments\Command\PaymentSetExternalIdAction',
                ['action', 'externalId']
            ],
            [
                '\Commercetools\Core\Request\Payments\Command\PaymentSetInterfaceIdAction',
                ['action', 'interfaceId']
            ],
            [
                '\Commercetools\Core\Request\Payments\Command\PaymentSetMethodInfoInterfaceAction',
                ['action', 'interface']
            ],
            [
                '\Commercetools\Core\Request\Payments\Command\PaymentSetMethodInfoMethodAction',
                ['action', 'method']
            ],
            [
                '\Commercetools\Core\Request\Payments\Command\PaymentSetMethodInfoNameAction',
                ['action', 'name']
            ],
            [
                '\Commercetools\Core\Request\Payments\Command\PaymentSetStatusInterfaceCodeAction',
                ['action', 'interfaceCode']
            ],
            [
                '\Commercetools\Core\Request\Payments\Command\PaymentSetStatusInterfaceTextAction',
                ['action', 'interfaceText']
            ],
            [
                '\Commercetools\Core\Request\Payments\Command\PaymentTransitionStateAction',
                ['action', 'state']
            ],
        ];
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
                    $this->getInstance('\Commercetools\Core\Model\Common\PriceDraft')
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
                    $this->getInstance('\Commercetools\Core\Model\Common\PriceDraft')
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
                '\Commercetools\Core\Request\Products\Command\ProductSetPriceCustomFieldAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Products\Command\ProductSetPriceCustomTypeAction',
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
                '\Commercetools\Core\Request\Carts\Command\CartAddPaymentAction',
                'of',
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
                '\Commercetools\Core\Request\Carts\Command\CartRemovePaymentAction',
                'of',
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
                '\Commercetools\Core\Request\Carts\Command\CartSetCustomLineItemCustomFieldAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Carts\Command\CartSetCustomLineItemCustomTypeAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Carts\Command\CartSetLineItemCustomFieldAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Carts\Command\CartSetLineItemCustomTypeAction',
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
            [
                '\Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeCartPredicateAction',
                'ofCartPredicate',
                ['cartPredicate']
            ],
            [
                '\Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeIsActiveAction',
                'ofIsActive',
                [true]
            ],
            [
                '\Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeNameAction',
                'ofName',
                [$this->getInstance('\Commercetools\Core\Model\Common\LocalizedString')]
            ],
            [
                '\Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeRequiresDiscountCodeAction',
                'ofRequiresDiscountCode',
                [true]
            ],
            [
                '\Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeSortOrderAction',
                'ofSortOrder',
                ['0.1']
            ],
            [
                '\Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeTargetAction',
                'ofTarget',
                ['target']
            ],
            [
                '\Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeValueAction',
                'ofCartDiscountValue',
                [$this->getInstance('\Commercetools\Core\Model\CartDiscount\CartDiscountValue')]
            ],
            [
                '\Commercetools\Core\Request\CartDiscounts\Command\CartDiscountSetDescriptionAction',
                'of'
            ],
            [
                '\Commercetools\Core\Request\CartDiscounts\Command\CartDiscountSetValidFromAction',
                'of'
            ],
            [
                '\Commercetools\Core\Request\CartDiscounts\Command\CartDiscountSetValidUntilAction',
                'of'
            ],
            [
                '\Commercetools\Core\Request\Channels\Command\ChannelAddRolesAction',
                'ofRoles',
                [[ChannelRole::INVENTORY_SUPPLY]]
            ],
            [
                '\Commercetools\Core\Request\Channels\Command\ChannelChangeDescriptionAction',
                'ofDescription',
                [$this->getInstance('\Commercetools\Core\Model\Common\LocalizedString')]
            ],
            [
                '\Commercetools\Core\Request\Channels\Command\ChannelChangeKeyAction',
                'ofKey',
                ['key']
            ],
            [
                '\Commercetools\Core\Request\Channels\Command\ChannelChangeNameAction',
                'ofName',
                [$this->getInstance('\Commercetools\Core\Model\Common\LocalizedString')]
            ],
            [
                '\Commercetools\Core\Request\Channels\Command\ChannelRemoveRolesAction',
                'ofRoles',
                [[ChannelRole::INVENTORY_SUPPLY]]
            ],
            [
                '\Commercetools\Core\Request\Channels\Command\ChannelSetRolesAction',
                'ofRoles',
                [[ChannelRole::INVENTORY_SUPPLY]]
            ],
            [
                '\Commercetools\Core\Request\CustomerGroups\Command\CustomerGroupChangeNameAction',
                'ofName',
                ['customerGroup']
            ],
            [
                '\Commercetools\Core\Request\CustomField\Command\SetCustomFieldAction',
                'ofName',
                ['fieldName']
            ],
            [
                '\Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction',
                'ofTypeId',
                ['typeId']
            ],
            [
                '\Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction',
                'ofTypeKey',
                ['typeKey']
            ],
            [
                '\Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction',
                'ofType',
                [TypeReference::ofId('typeId')]
            ],
            [
                '\Commercetools\Core\Request\Zones\Command\ZoneAddLocationAction',
                'ofLocation',
                [$this->getInstance('\Commercetools\Core\Model\Zone\Location')]
            ],
            [
                '\Commercetools\Core\Request\Zones\Command\ZoneChangeNameAction',
                'ofName',
                ['newName']
            ],
            [
                '\Commercetools\Core\Request\Zones\Command\ZoneRemoveLocationAction',
                'ofLocation',
                [$this->getInstance('\Commercetools\Core\Model\Zone\Location')]
            ],
            [
                '\Commercetools\Core\Request\Zones\Command\ZoneSetDescriptionAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\TaxCategories\Command\TaxCategoryAddTaxRateAction',
                'ofTaxRate',
                [$this->getInstance('\Commercetools\Core\Model\TaxCategory\TaxRate')]
            ],
            [
                '\Commercetools\Core\Request\TaxCategories\Command\TaxCategoryChangeNameAction',
                'ofName',
                ['newName']
            ],
            [
                '\Commercetools\Core\Request\TaxCategories\Command\TaxCategoryRemoveTaxRateAction',
                'ofTaxRateId',
                ['taxRateId']
            ],
            [
                '\Commercetools\Core\Request\TaxCategories\Command\TaxCategoryReplaceTaxRateAction',
                'ofTaxRateIdAndTaxRate',
                ['taxRateId', $this->getInstance('\Commercetools\Core\Model\TaxCategory\TaxRate')]
            ],
            [
                '\Commercetools\Core\Request\TaxCategories\Command\TaxCategorySetDescriptionAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Reviews\Command\ReviewSetAuthorNameAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Reviews\Command\ReviewSetScoreAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Reviews\Command\ReviewSetTextAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Reviews\Command\ReviewSetTitleAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Reviews\Command\ReviewTransitionStateAction',
                'ofState',
                [$this->getInstance('\Commercetools\Core\Model\State\StateReference')]
            ],
            [
                '\Commercetools\Core\Request\Types\Command\TypeAddEnumValueAction',
                'ofEnum',
                [$this->getInstance('\Commercetools\Core\Model\Common\Enum')]
            ],
            [
                '\Commercetools\Core\Request\Types\Command\TypeAddFieldDefinitionAction',
                'ofFieldDefinition',
                [$this->getInstance('\Commercetools\Core\Model\Type\FieldDefinition')]
            ],
            [
                '\Commercetools\Core\Request\Types\Command\TypeAddLocalizedEnumValueAction',
                'ofEnum',
                [$this->getInstance('\Commercetools\Core\Model\Common\LocalizedEnum')]
            ],
            [
                '\Commercetools\Core\Request\Types\Command\TypeChangeEnumValueOrderAction',
                'ofEnums',
                [['key1', 'key2']]
            ],
            [
                '\Commercetools\Core\Request\Types\Command\TypeChangeFieldDefinitionOrderAction',
                'ofFieldDefinitions',
                [['name1', 'name2']]
            ],
            [
                '\Commercetools\Core\Request\Types\Command\TypeChangeLabelAction',
                'ofLabel',
                [$this->getInstance('\Commercetools\Core\Model\Common\LocalizedString')]
            ],
            [
                '\Commercetools\Core\Request\Types\Command\TypeChangeLocalizedEnumValueOrderAction',
                'ofEnums',
                [['key1', 'key2']]
            ],
            [
                '\Commercetools\Core\Request\Types\Command\TypeChangeNameAction',
                'ofName',
                [$this->getInstance('\Commercetools\Core\Model\Common\LocalizedString')]
            ],
            [
                '\Commercetools\Core\Request\Types\Command\TypeRemoveFieldDefinitionAction',
                'ofFieldName',
                ['fieldName']
            ],
            [
                '\Commercetools\Core\Request\Types\Command\TypeSetDescriptionAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\States\Command\StateChangeInitialAction',
                'ofInitial',
                [true]
            ],
            [
                '\Commercetools\Core\Request\States\Command\StateChangeKeyAction',
                'ofKey',
                ['newKey']
            ],
            [
                '\Commercetools\Core\Request\States\Command\StateChangeTypeAction',
                'ofType',
                ['newType']
            ],
            [
                '\Commercetools\Core\Request\States\Command\StateSetDescriptionAction',
                'ofDescription',
                [$this->getInstance('\Commercetools\Core\Model\Common\LocalizedString')]
            ],
            [
                '\Commercetools\Core\Request\States\Command\StateSetNameAction',
                'ofName',
                [$this->getInstance('\Commercetools\Core\Model\Common\LocalizedString')]
            ],
            [
                '\Commercetools\Core\Request\States\Command\StateSetTransitionsAction',
                'ofTransitions',
                [$this->getInstance('\Commercetools\Core\Model\State\StateReferenceCollection')]
            ],
            [
                '\Commercetools\Core\Request\States\Command\TransitionStateAction',
                'ofState',
                [$this->getInstance('\Commercetools\Core\Model\State\StateReference')]
            ],
            [
                '\Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeChangeCartDiscountsAction',
                'ofCartDiscountReferences',
                [$this->getInstance('\Commercetools\Core\Model\CartDiscount\CartDiscountReferenceCollection')]
            ],
            [
                '\Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeChangeCartDiscountsAction',
                'ofCartDiscountReference',
                [$this->getInstance('\Commercetools\Core\Model\CartDiscount\CartDiscountReference')]
            ],
            [
                '\Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeChangeIsActiveAction',
                'ofIsActive',
                [true]
            ],
            [
                '\Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetCartPredicateAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetDescriptionAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetMaxApplicationsAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetMaxApplicationsPerCustomerAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetNameAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Inventory\Command\InventoryAddQuantityAction',
                'ofQuantity',
                [1]
            ],
            [
                '\Commercetools\Core\Request\Inventory\Command\InventoryChangeQuantityAction',
                'ofQuantity',
                [2]
            ],
            [
                '\Commercetools\Core\Request\Inventory\Command\InventoryRemoveQuantityAction',
                'ofQuantity',
                [3]
            ],
            [
                '\Commercetools\Core\Request\Inventory\Command\InventorySetExpectedDeliveryAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Inventory\Command\InventorySetRestockableInDaysAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountChangeIsActiveAction',
                'ofIsActive',
                [true]
            ],
            [
                '\Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountChangeNameAction',
                'ofName',
                [$this->getInstance('\Commercetools\Core\Model\Common\LocalizedString')]
            ],
            [
                '\Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountChangePredicateAction',
                'ofPredicate',
                ['predicate']
            ],
            [
                '\Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountChangeSortOrderAction',
                'ofSortOrder',
                ['sortOrder']
            ],
            [
                '\Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountChangeValueAction',
                'ofProductDiscountValue',
                [$this->getInstance('\Commercetools\Core\Model\ProductDiscount\ProductDiscountValue')]
            ],
            [
                '\Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountSetDescriptionAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodAddShippingRateAction',
                'ofZoneAndShippingRate',
                [
                    $this->getInstance('\Commercetools\Core\Model\Zone\ZoneReference'),
                    $this->getInstance('\Commercetools\Core\Model\ShippingMethod\ShippingRate')
                ]
            ],
            [
                '\Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodAddZoneAction',
                'ofZone',
                [$this->getInstance('\Commercetools\Core\Model\Zone\ZoneReference')]
            ],
            [
                '\Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodChangeIsDefaultAction',
                'ofIsDefault',
                [true]
            ],
            [
                '\Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodChangeNameAction',
                'ofName',
                ['newName']
            ],
            [
                '\Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodChangeTaxCategoryAction',
                'ofTaxCategory',
                [$this->getInstance('\Commercetools\Core\Model\TaxCategory\TaxCategoryReference')]
            ],
            [
                '\Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodRemoveShippingRateAction',
                'ofZoneAndShippingRate',
                [
                    $this->getInstance('\Commercetools\Core\Model\Zone\ZoneReference'),
                    $this->getInstance('\Commercetools\Core\Model\ShippingMethod\ShippingRate')
                ]
            ],
            [
                '\Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodRemoveZoneAction',
                'ofZone',
                [$this->getInstance('\Commercetools\Core\Model\Zone\ZoneReference')]
            ],
            [
                '\Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodSetDescriptionAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\ProductTypes\Command\ProductTypeAddAttributeDefinitionAction',
                'ofAttribute',
                [$this->getInstance('\Commercetools\Core\Model\ProductType\AttributeDefinition')]
            ],
            [
                '\Commercetools\Core\Request\ProductTypes\Command\ProductTypeAddLocalizedEnumValueAction',
                'ofAttributeNameAndValue',
                [
                    'attributeName',
                    $this->getInstance('\Commercetools\Core\Model\Common\LocalizedEnum')
                ]
            ],
            [
                '\Commercetools\Core\Request\ProductTypes\Command\ProductTypeAddPlainEnumValueAction',
                'ofAttributeNameAndValue',
                [
                    'attributeName',
                    $this->getInstance('\Commercetools\Core\Model\Common\Enum')
                ]
            ],
            [
                '\Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeAttributeOrderAction',
                'ofAttributes',
                [$this->getInstance('\Commercetools\Core\Model\ProductType\AttributeDefinitionCollection')]
            ],
            [
                '\Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeDescriptionAction',
                'ofDescription',
                ['new description']
            ],
            [
                '\Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeLabelAction',
                'ofAttributeNameAndLabel',
                ['attributeName', $this->getInstance('\Commercetools\Core\Model\Common\LocalizedString')]
            ],
            [
                '\Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeLocalizedEnumValueOrderAction',
                'ofAttributeNameAndValues',
                ['attributeName', $this->getInstance('\Commercetools\Core\Model\Common\LocalizedEnumCollection')]
            ],
            [
                '\Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeNameAction',
                'ofName',
                ['new name']
            ],
            [
                '\Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangePlainEnumValueOrderAction',
                'ofAttributeNameAndValues',
                ['attributeName', $this->getInstance('\Commercetools\Core\Model\Common\EnumCollection')]
            ],
            [
                '\Commercetools\Core\Request\ProductTypes\Command\ProductTypeRemoveAttributeDefinitionAction',
                'ofName',
                ['name']
            ],
            [
                '\Commercetools\Core\Request\Payments\Command\PaymentAddInterfaceInteractionAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Payments\Command\PaymentAddTransactionAction',
                'ofTransaction',
                [$this->getInstance('\Commercetools\Core\Model\Payment\Transaction')]
            ],
            [
                '\Commercetools\Core\Request\Payments\Command\PaymentSetAmountPaidAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Payments\Command\PaymentSetAmountRefundedAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Payments\Command\PaymentSetAuthorizationAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Payments\Command\PaymentSetCustomerAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Payments\Command\PaymentSetCustomFieldAction',
                'ofName',
                ['name']
            ],
            [
                '\Commercetools\Core\Request\Payments\Command\PaymentSetCustomTypeAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Payments\Command\PaymentSetExternalIdAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Payments\Command\PaymentSetInterfaceIdAction',
                'ofInterfaceId',
                ['interfaceId']
            ],
            [
                '\Commercetools\Core\Request\Payments\Command\PaymentSetMethodInfoInterfaceAction',
                'ofInterface',
                ['interface']
            ],
            [
                '\Commercetools\Core\Request\Payments\Command\PaymentSetMethodInfoMethodAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Payments\Command\PaymentSetMethodInfoNameAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Payments\Command\PaymentSetStatusInterfaceCodeAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Payments\Command\PaymentSetStatusInterfaceTextAction',
                'of',
            ],
            [
                '\Commercetools\Core\Request\Payments\Command\PaymentTransitionStateAction',
                'ofState',
                [$this->getInstance('\Commercetools\Core\Model\State\StateReference')]
            ],
        ];
    }
}
