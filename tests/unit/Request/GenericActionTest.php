<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\Model\CartDiscount\CartDiscountReference;
use Commercetools\Core\Model\CartDiscount\CartDiscountReferenceCollection;
use Commercetools\Core\Model\CartDiscount\CartDiscountTarget;
use Commercetools\Core\Model\CartDiscount\CartDiscountValue;
use Commercetools\Core\Model\Category\CategoryReference;
use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\Channel\ChannelRole;
use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\Enum;
use Commercetools\Core\Model\Common\EnumCollection;
use Commercetools\Core\Model\Common\Image;
use Commercetools\Core\Model\Common\LocalizedEnum;
use Commercetools\Core\Model\Common\LocalizedEnumCollection;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\PriceDraft;
use Commercetools\Core\Model\Common\PriceDraftCollection;
use Commercetools\Core\Model\DiscountCode\DiscountCodeReference;
use Commercetools\Core\Model\Order\DeliveryItemCollection;
use Commercetools\Core\Model\Order\ItemStateCollection;
use Commercetools\Core\Model\Payment\Transaction;
use Commercetools\Core\Model\Product\LocalizedSearchKeywords;
use Commercetools\Core\Model\ProductDiscount\ProductDiscountValue;
use Commercetools\Core\Model\ProductType\AttributeDefinition;
use Commercetools\Core\Model\ProductType\AttributeDefinitionCollection;
use Commercetools\Core\Model\ShippingMethod\ShippingRate;
use Commercetools\Core\Model\State\StateReference;
use Commercetools\Core\Model\State\StateReferenceCollection;
use Commercetools\Core\Model\TaxCategory\TaxCategoryReference;
use Commercetools\Core\Model\TaxCategory\TaxRate;
use Commercetools\Core\Model\Type\FieldDefinition;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Model\Zone\Location;
use Commercetools\Core\Model\Zone\ZoneReference;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeCartPredicateAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeIsActiveAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeNameAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeRequiresDiscountCodeAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeSortOrderAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeTargetAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeValueAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountSetDescriptionAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountSetValidFromAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountSetValidUntilAction;
use Commercetools\Core\Request\Carts\Command\CartAddCustomLineItemAction;
use Commercetools\Core\Request\Carts\Command\CartAddDiscountCodeAction;
use Commercetools\Core\Request\Carts\Command\CartAddLineItemAction;
use Commercetools\Core\Request\Carts\Command\CartAddPaymentAction;
use Commercetools\Core\Request\Carts\Command\CartChangeLineItemQuantityAction;
use Commercetools\Core\Request\Carts\Command\CartRecalculateAction;
use Commercetools\Core\Request\Carts\Command\CartRemoveCustomLineItemAction;
use Commercetools\Core\Request\Carts\Command\CartRemoveDiscountCodeAction;
use Commercetools\Core\Request\Carts\Command\CartRemoveLineItemAction;
use Commercetools\Core\Request\Carts\Command\CartRemovePaymentAction;
use Commercetools\Core\Request\Carts\Command\CartSetBillingAddressAction;
use Commercetools\Core\Request\Carts\Command\CartSetCountryAction;
use Commercetools\Core\Request\Carts\Command\CartSetCustomerEmailAction;
use Commercetools\Core\Request\Carts\Command\CartSetCustomerIdAction;
use Commercetools\Core\Request\Carts\Command\CartSetCustomLineItemCustomFieldAction;
use Commercetools\Core\Request\Carts\Command\CartSetCustomLineItemCustomTypeAction;
use Commercetools\Core\Request\Carts\Command\CartSetCustomShippingMethodAction;
use Commercetools\Core\Request\Carts\Command\CartSetLineItemCustomFieldAction;
use Commercetools\Core\Request\Carts\Command\CartSetLineItemCustomTypeAction;
use Commercetools\Core\Request\Carts\Command\CartSetShippingAddressAction;
use Commercetools\Core\Request\Carts\Command\CartSetShippingMethodAction;
use Commercetools\Core\Request\Categories\Command\CategoryChangeNameAction;
use Commercetools\Core\Request\Categories\Command\CategoryChangeOrderHintAction;
use Commercetools\Core\Request\Categories\Command\CategoryChangeParentAction;
use Commercetools\Core\Request\Categories\Command\CategoryChangeSlugAction;
use Commercetools\Core\Request\Categories\Command\CategorySetDescriptionAction;
use Commercetools\Core\Request\Categories\Command\CategorySetExternalIdAction;
use Commercetools\Core\Request\Categories\Command\CategorySetMetaDescriptionAction;
use Commercetools\Core\Request\Categories\Command\CategorySetMetaKeywordsAction;
use Commercetools\Core\Request\Categories\Command\CategorySetMetaTitleAction;
use Commercetools\Core\Request\Channels\Command\ChannelAddRolesAction;
use Commercetools\Core\Request\Channels\Command\ChannelChangeDescriptionAction;
use Commercetools\Core\Request\Channels\Command\ChannelChangeKeyAction;
use Commercetools\Core\Request\Channels\Command\ChannelChangeNameAction;
use Commercetools\Core\Request\Channels\Command\ChannelRemoveRolesAction;
use Commercetools\Core\Request\Channels\Command\ChannelSetRolesAction;
use Commercetools\Core\Request\CustomerGroups\Command\CustomerGroupChangeNameAction;
use Commercetools\Core\Request\Customers\Command\CustomerAddAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerChangeAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerChangeEmailAction;
use Commercetools\Core\Request\Customers\Command\CustomerChangeNameAction;
use Commercetools\Core\Request\Customers\Command\CustomerRemoveAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetCompanyNameAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetCustomerGroupAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetCustomerNumberAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetDateOfBirthAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetDefaultBillingAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetDefaultShippingAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetExternalIdAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetFirstNameAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetLastNameAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetMiddleNameAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetTitleAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetVatIdAction;
use Commercetools\Core\Request\CustomField\Command\SetCustomFieldAction;
use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeChangeCartDiscountsAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeChangeIsActiveAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetCartPredicateAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetDescriptionAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetMaxApplicationsAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetMaxApplicationsPerCustomerAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetNameAction;
use Commercetools\Core\Request\Inventory\Command\InventoryAddQuantityAction;
use Commercetools\Core\Request\Inventory\Command\InventoryChangeQuantityAction;
use Commercetools\Core\Request\Inventory\Command\InventoryRemoveQuantityAction;
use Commercetools\Core\Request\Inventory\Command\InventorySetExpectedDeliveryAction;
use Commercetools\Core\Request\Inventory\Command\InventorySetRestockableInDaysAction;
use Commercetools\Core\Request\Inventory\Command\InventorySetSupplyChannelAction;
use Commercetools\Core\Request\Me\Command\MyCartAddLineItemAction;
use Commercetools\Core\Request\Orders\Command\OrderAddDeliveryAction;
use Commercetools\Core\Request\Orders\Command\OrderAddParcelToDeliveryAction;
use Commercetools\Core\Request\Orders\Command\OrderAddReturnInfoAction;
use Commercetools\Core\Request\Orders\Command\OrderChangeOrderStateAction;
use Commercetools\Core\Request\Orders\Command\OrderChangePaymentStateAction;
use Commercetools\Core\Request\Orders\Command\OrderChangeShipmentStateAction;
use Commercetools\Core\Request\Orders\Command\OrderImportCustomLineItemStateAction;
use Commercetools\Core\Request\Orders\Command\OrderImportLineItemStateAction;
use Commercetools\Core\Request\Orders\Command\OrderSetOrderNumberAction;
use Commercetools\Core\Request\Orders\Command\OrderSetReturnPaymentStateAction;
use Commercetools\Core\Request\Orders\Command\OrderSetReturnShipmentStateAction;
use Commercetools\Core\Request\Orders\Command\OrderTransitionCustomLineItemStateAction;
use Commercetools\Core\Request\Orders\Command\OrderTransitionLineItemStateAction;
use Commercetools\Core\Request\Orders\Command\OrderUpdateSyncInfoAction;
use Commercetools\Core\Request\Payments\Command\PaymentAddInterfaceInteractionAction;
use Commercetools\Core\Request\Payments\Command\PaymentAddTransactionAction;
use Commercetools\Core\Request\Payments\Command\PaymentChangeAmountPlannedAction;
use Commercetools\Core\Request\Payments\Command\PaymentChangeTransactionInteractionIdAction;
use Commercetools\Core\Request\Payments\Command\PaymentChangeTransactionStateAction;
use Commercetools\Core\Request\Payments\Command\PaymentChangeTransactionTimestampAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetAmountPaidAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetAmountRefundedAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetAuthorizationAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetCustomerAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetCustomFieldAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetCustomTypeAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetExternalIdAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetInterfaceIdAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetMethodInfoInterfaceAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetMethodInfoMethodAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetMethodInfoNameAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetStatusInterfaceCodeAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetStatusInterfaceTextAction;
use Commercetools\Core\Request\Payments\Command\PaymentTransitionStateAction;
use Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountChangeIsActiveAction;
use Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountChangeNameAction;
use Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountChangePredicateAction;
use Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountChangeSortOrderAction;
use Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountChangeValueAction;
use Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountSetDescriptionAction;
use Commercetools\Core\Request\Products\Command\ProductAddExternalImageAction;
use Commercetools\Core\Request\Products\Command\ProductAddPriceAction;
use Commercetools\Core\Request\Products\Command\ProductAddToCategoryAction;
use Commercetools\Core\Request\Products\Command\ProductAddVariantAction;
use Commercetools\Core\Request\Products\Command\ProductChangeNameAction;
use Commercetools\Core\Request\Products\Command\ProductChangePriceAction;
use Commercetools\Core\Request\Products\Command\ProductChangeSlugAction;
use Commercetools\Core\Request\Products\Command\ProductPublishAction;
use Commercetools\Core\Request\Products\Command\ProductRemoveFromCategoryAction;
use Commercetools\Core\Request\Products\Command\ProductRemoveImageAction;
use Commercetools\Core\Request\Products\Command\ProductRemovePriceAction;
use Commercetools\Core\Request\Products\Command\ProductRemoveVariantAction;
use Commercetools\Core\Request\Products\Command\ProductRevertStagedChangesAction;
use Commercetools\Core\Request\Products\Command\ProductSetAttributeAction;
use Commercetools\Core\Request\Products\Command\ProductSetAttributeInAllVariantsAction;
use Commercetools\Core\Request\Products\Command\ProductSetCategoryOrderHintAction;
use Commercetools\Core\Request\Products\Command\ProductSetDescriptionAction;
use Commercetools\Core\Request\Products\Command\ProductSetMetaAttributesAction;
use Commercetools\Core\Request\Products\Command\ProductSetMetaDescriptionAction;
use Commercetools\Core\Request\Products\Command\ProductSetMetaKeywordsAction;
use Commercetools\Core\Request\Products\Command\ProductSetMetaTitleAction;
use Commercetools\Core\Request\Products\Command\ProductSetPriceCustomFieldAction;
use Commercetools\Core\Request\Products\Command\ProductSetPriceCustomTypeAction;
use Commercetools\Core\Request\Products\Command\ProductSetPricesAction;
use Commercetools\Core\Request\Products\Command\ProductSetSearchKeywordsAction;
use Commercetools\Core\Request\Products\Command\ProductSetSkuNotStageableAction;
use Commercetools\Core\Request\Products\Command\ProductSetTaxCategoryAction;
use Commercetools\Core\Request\Products\Command\ProductTransitionStateAction;
use Commercetools\Core\Request\Products\Command\ProductUnpublishAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeAddAttributeDefinitionAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeAddLocalizedEnumValueAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeAddPlainEnumValueAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeAttributeOrderAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeDescriptionAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeIsSearchableAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeLabelAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeLocalizedEnumValueOrderAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeNameAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangePlainEnumValueOrderAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeRemoveAttributeDefinitionAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeSetInputTipAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeSetKeyAction;
use Commercetools\Core\Request\Reviews\Command\ReviewSetAuthorNameAction;
use Commercetools\Core\Request\Reviews\Command\ReviewSetCustomerAction;
use Commercetools\Core\Request\Reviews\Command\ReviewSetKeyAction;
use Commercetools\Core\Request\Reviews\Command\ReviewSetTargetAction;
use Commercetools\Core\Request\Reviews\Command\ReviewSetTextAction;
use Commercetools\Core\Request\Reviews\Command\ReviewSetTitleAction;
use Commercetools\Core\Request\Reviews\Command\ReviewTransitionStateAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodAddShippingRateAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodAddZoneAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodChangeIsDefaultAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodChangeNameAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodChangeTaxCategoryAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodRemoveShippingRateAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodRemoveZoneAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodSetDescriptionAction;
use Commercetools\Core\Request\States\Command\StateAddRolesAction;
use Commercetools\Core\Request\States\Command\StateChangeInitialAction;
use Commercetools\Core\Request\States\Command\StateChangeKeyAction;
use Commercetools\Core\Request\States\Command\StateChangeTypeAction;
use Commercetools\Core\Request\States\Command\StateRemoveRolesAction;
use Commercetools\Core\Request\States\Command\StateSetDescriptionAction;
use Commercetools\Core\Request\States\Command\StateSetNameAction;
use Commercetools\Core\Request\States\Command\StateSetRolesAction;
use Commercetools\Core\Request\States\Command\StateSetTransitionsAction;
use Commercetools\Core\Request\States\Command\TransitionStateAction;
use Commercetools\Core\Request\Stores\Command\StoreSetNameAction;
use Commercetools\Core\Request\TaxCategories\Command\TaxCategoryAddTaxRateAction;
use Commercetools\Core\Request\TaxCategories\Command\TaxCategoryChangeNameAction;
use Commercetools\Core\Request\TaxCategories\Command\TaxCategoryRemoveTaxRateAction;
use Commercetools\Core\Request\TaxCategories\Command\TaxCategoryReplaceTaxRateAction;
use Commercetools\Core\Request\TaxCategories\Command\TaxCategorySetDescriptionAction;
use Commercetools\Core\Request\Types\Command\TypeAddEnumValueAction;
use Commercetools\Core\Request\Types\Command\TypeAddFieldDefinitionAction;
use Commercetools\Core\Request\Types\Command\TypeAddLocalizedEnumValueAction;
use Commercetools\Core\Request\Types\Command\TypeChangeEnumValueOrderAction;
use Commercetools\Core\Request\Types\Command\TypeChangeFieldDefinitionOrderAction;
use Commercetools\Core\Request\Types\Command\TypeChangeKeyAction;
use Commercetools\Core\Request\Types\Command\TypeChangeLabelAction;
use Commercetools\Core\Request\Types\Command\TypeChangeLocalizedEnumValueOrderAction;
use Commercetools\Core\Request\Types\Command\TypeChangeNameAction;
use Commercetools\Core\Request\Types\Command\TypeRemoveFieldDefinitionAction;
use Commercetools\Core\Request\Types\Command\TypeSetDescriptionAction;
use Commercetools\Core\Request\Zones\Command\ZoneAddLocationAction;
use Commercetools\Core\Request\Zones\Command\ZoneChangeNameAction;
use Commercetools\Core\Request\Zones\Command\ZoneRemoveLocationAction;
use Commercetools\Core\Request\Zones\Command\ZoneSetDescriptionAction;

class GenericActionTest extends \PHPUnit\Framework\TestCase
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
        $actions = [
            [
                AbstractAction::class,
                ['action']
            ],
            [
                SetCustomFieldAction::class,
                ['action', 'name', 'value']
            ],
            [
                SetCustomTypeAction::class,
                ['action', 'type', 'fields']
            ],
            [
                TransitionStateAction::class,
                ['action', 'state', 'force']
            ],
            [
                PaymentSetExternalIdAction::class,
                ['action', 'externalId']
            ],
        ];

        $actionNames = array_map(function ($value) {
            return current($value);
        }, $actions);

        return array_combine($actionNames, $actions);
    }

    public function actionArgumentProvider()
    {
        $actions = [
            [
                AbstractAction::class,
                'of',
            ],
            [
                ProductAddExternalImageAction::class,
                'ofVariantIdAndImage',
                [
                    10,
                    $this->getInstance(Image::class)
                ]
            ],
            [
                ProductAddPriceAction::class,
                'ofVariantIdAndPrice',
                [
                    10,
                    $this->getInstance(PriceDraft::class)
                ]
            ],
            [
                ProductAddToCategoryAction::class,
                'ofCategory',
                [
                    $this->getInstance(CategoryReference::class)
                ]
            ],
            [
                ProductAddVariantAction::class,
                'of',
            ],
            [
                ProductChangeNameAction::class,
                'ofName',
                [
                    $this->getInstance(LocalizedString::class)
                ]
            ],
            [
                ProductChangePriceAction::class,
                'ofPriceIdAndPrice',
                [
                    '10',
                    $this->getInstance(PriceDraft::class)
                ]
            ],
            [
                ProductChangeSlugAction::class,
                'ofSlug',
                [
                    $this->getInstance(LocalizedString::class)
                ]
            ],
            [
                ProductPublishAction::class,
                'of',
            ],
            [
                ProductRemoveFromCategoryAction::class,
                'ofCategory',
                [
                    $this->getInstance(CategoryReference::class)
                ]
            ],
            [
                ProductRemoveImageAction::class,
                'ofVariantIdAndImageUrl',
                [10, 'imageUrl']
            ],
            [
                ProductRemovePriceAction::class,
                'ofPriceId',
                [
                    '10'
                ]
            ],
            [
                ProductRemoveVariantAction::class,
                'ofVariantId',
                [10]
            ],
            [
                ProductRevertStagedChangesAction::class,
                'of'
            ],
            [
                ProductSetAttributeAction::class,
                'ofVariantIdAndName',
                [10, 'attributeName']
            ],
            [
                ProductSetAttributeInAllVariantsAction::class,
                'ofName',
                ['attributeName']
            ],
            [
                ProductSetCategoryOrderHintAction::class,
                'ofCategoryId',
                ['categoryId']
            ],
            [
                ProductSetDescriptionAction::class,
                'ofDescription',
                [
                    $this->getInstance(LocalizedString::class)
                ]
            ],
            [
                ProductSetMetaTitleAction::class,
                'of',
            ],
            [
                ProductSetMetaDescriptionAction::class,
                'of',
            ],
            [
                ProductSetMetaKeywordsAction::class,
                'of',
            ],
            [
                ProductSetPriceCustomFieldAction::class,
                'of',
            ],
            [
                ProductSetPriceCustomTypeAction::class,
                'of',
            ],
            [
                ProductSetPricesAction::class,
                'ofVariantIdAndPrices',
                [
                    1,
                    $this->getInstance(PriceDraftCollection::class)
                ]
            ],
            [
                ProductSetSearchKeywordsAction::class,
                'ofKeywords',
                [
                    $this->getInstance(LocalizedSearchKeywords::class)
                ]
            ],
            [
                ProductSetTaxCategoryAction::class,
                'of',
            ],
            [
                ProductTransitionStateAction::class,
                'ofState',
                [$this->getInstance(StateReference::class)]
            ],
            [
                ProductUnpublishAction::class,
                'of',
            ],
            [
                OrderAddDeliveryAction::class,
                'ofDeliveryItems',
                [
                    $this->getInstance(DeliveryItemCollection::class)
                ]
            ],
            [
                OrderAddParcelToDeliveryAction::class,
                'ofDeliveryId',
                ['1234567890']
            ],
            [
                OrderAddReturnInfoAction::class,
                'of',
            ],
            [
                OrderChangeOrderStateAction::class,
                'ofOrderState',
                ['newOrderState']
            ],
            [
                OrderChangePaymentStateAction::class,
                'ofPaymentState',
                ['newPaymentState']
            ],
            [
                OrderChangeShipmentStateAction::class,
                'ofShipmentState',
                ['newShipmentState']
            ],
            [
                OrderImportCustomLineItemStateAction::class,
                'ofCustomLineItemIdAndState',
                [
                    '12345',
                    $this->getInstance(ItemStateCollection::class)
                ]
            ],
            [
                OrderImportLineItemStateAction::class,
                'ofLineItemIdAndState',
                [
                    '12345',
                    $this->getInstance(ItemStateCollection::class)
                ]
            ],
            [
                OrderSetOrderNumberAction::class,
                'of',
            ],
            [
                OrderSetReturnPaymentStateAction::class,
                'ofReturnItemIdAndPaymentState',
                ['12345', 'paymentState']
            ],
            [
                OrderSetReturnShipmentStateAction::class,
                'ofReturnItemIdAndShipmentState',
                ['12345', 'shipmentState']
            ],
            [
                OrderTransitionCustomLineItemStateAction::class,
                'ofCustomLineItemIdQuantityAndFromToState',
                [
                    '12345',
                    2,
                    $this->getInstance(StateReference::class),
                    $this->getInstance(StateReference::class),
                ]
            ],
            [
                OrderTransitionLineItemStateAction::class,
                'ofLineItemIdQuantityAndFromToState',
                [
                    '12345',
                    2,
                    $this->getInstance(StateReference::class),
                    $this->getInstance(StateReference::class),
                ]
            ],
            [
                OrderUpdateSyncInfoAction::class,
                'ofChannel',
                [
                    $this->getInstance(ChannelReference::class)
                ]
            ],
            [
                CustomerAddAddressAction::class,
                'ofAddress',
                [
                    $this->getInstance(Address::class)
                ]
            ],
            [
                CustomerChangeAddressAction::class,
                'ofAddressIdAndAddress',
                [
                    '1',
                    $this->getInstance(Address::class)
                ]
            ],
            [
                CustomerChangeEmailAction::class,
                'ofEmail',
                ['john.doe@company.com']
            ],
            [
                CustomerRemoveAddressAction::class,
                'ofAddressId',
                ['1']
            ],
            [
                CustomerSetCompanyNameAction::class,
                'of',
            ],
            [
                CustomerSetCustomerGroupAction::class,
                'of',
            ],
            [
                CustomerSetCustomerNumberAction::class,
                'of',
            ],
            [
                CustomerSetDateOfBirthAction::class,
                'of',
            ],
            [
                CustomerSetDefaultBillingAddressAction::class,
                'of',
            ],
            [
                CustomerSetDefaultShippingAddressAction::class,
                'of',
            ],
            [
                CustomerSetExternalIdAction::class,
                'of',
            ],
            [
                CustomerSetFirstNameAction::class,
                'of',
            ],
            [
                CustomerSetLastNameAction::class,
                'of',
            ],
            [
                CustomerSetMiddleNameAction::class,
                'of',
            ],
            [
                CustomerSetTitleAction::class,
                'of',
            ],
            [
                CustomerSetVatIdAction::class,
                'of',
            ],
            [
                CategoryChangeNameAction::class,
                'ofName',
                [
                    $this->getInstance(LocalizedString::class)
                ]
            ],
            [
                CategoryChangeOrderHintAction::class,
                'ofOrderHint',
                ['orderHint']
            ],
            [
                CategoryChangeParentAction::class,
                'ofParentCategory',
                [
                    $this->getInstance(CategoryReference::class)
                ]
            ],
            [
                CategoryChangeSlugAction::class,
                'ofSlug',
                [
                    $this->getInstance(LocalizedString::class)
                ]
            ],
            [
                CategorySetDescriptionAction::class,
                'ofDescription',
                [
                    $this->getInstance(LocalizedString::class)
                ]
            ],
            [
                CategorySetExternalIdAction::class,
                'ofExternalId',
                ['externalId']
            ],
            [
                CategorySetMetaTitleAction::class,
                'of',
            ],
            [
                CategorySetMetaDescriptionAction::class,
                'of',
            ],
            [
                CategorySetMetaKeywordsAction::class,
                'of',
            ],
            [
                CartAddCustomLineItemAction::class,
                'ofNameQuantityMoneySlugAndTaxCategory',
                [
                    $this->getInstance(LocalizedString::class),
                    10,
                    $this->getInstance(Money::class),
                    'my-custom-line-item',
                    $this->getInstance(TaxCategoryReference::class)
                ]
            ],
            [
                CartAddDiscountCodeAction::class,
                'ofCode',
                ['code']
            ],
            [
                CartAddLineItemAction::class,
                'ofProductIdVariantIdAndQuantity',
                ['productId', 1, 2]
            ],
            [
                MyCartAddLineItemAction::class,
                'ofProductIdVariantIdAndQuantity',
                ['productId', 1, 2]
            ],
            [
                CartAddPaymentAction::class,
                'of',
            ],
            [
                CartChangeLineItemQuantityAction::class,
                'ofLineItemIdAndQuantity',
                ['lineItemId', 3]
            ],
            [
                CartRecalculateAction::class,
                'of',
            ],
            [
                CartRemoveCustomLineItemAction::class,
                'ofCustomLineItemId',
                ['customLineItemId']
            ],
            [
                CartRemoveDiscountCodeAction::class,
                'ofDiscountCode',
                [
                    $this->getInstance(DiscountCodeReference::class)
                ]
            ],
            [
                CartRemoveLineItemAction::class,
                'ofLineItemId',
                ['lineItemId', 1]
            ],
            [
                CartRemovePaymentAction::class,
                'of',
            ],
            [
                CartSetBillingAddressAction::class,
                'of',
            ],
            [
                CartSetCountryAction::class,
                'of',
            ],
            [
                CartSetCustomerEmailAction::class,
                'of',
            ],
            [
                CartSetCustomerIdAction::class,
                'of',
            ],
            [
                CartSetCustomLineItemCustomFieldAction::class,
                'of',
            ],
            [
                CartSetCustomLineItemCustomTypeAction::class,
                'of',
            ],
            [
                CartSetLineItemCustomFieldAction::class,
                'of',
            ],
            [
                CartSetLineItemCustomTypeAction::class,
                'of',
            ],
            [
                CartSetShippingAddressAction::class,
                'of',
            ],
            [
                CartSetShippingMethodAction::class,
                'of',
            ],
            [
                CartSetCustomShippingMethodAction::class,
                'of',
            ],
            [
                CartDiscountChangeCartPredicateAction::class,
                'ofCartPredicate',
                ['cartPredicate']
            ],
            [
                CartDiscountChangeIsActiveAction::class,
                'ofIsActive',
                [true]
            ],
            [
                CartDiscountChangeNameAction::class,
                'ofName',
                [$this->getInstance(LocalizedString::class)]
            ],
            [
                CartDiscountChangeRequiresDiscountCodeAction::class,
                'ofRequiresDiscountCode',
                [true]
            ],
            [
                CartDiscountChangeSortOrderAction::class,
                'ofSortOrder',
                ['0.1']
            ],
            [
                CartDiscountChangeTargetAction::class,
                'ofTarget',
                [$this->getInstance(CartDiscountTarget::class)]
            ],
            [
                CartDiscountChangeValueAction::class,
                'ofCartDiscountValue',
                [$this->getInstance(CartDiscountValue::class)]
            ],
            [
                CartDiscountSetDescriptionAction::class,
                'of'
            ],
            [
                CartDiscountSetValidFromAction::class,
                'of'
            ],
            [
                CartDiscountSetValidUntilAction::class,
                'of'
            ],
            [
                ChannelAddRolesAction::class,
                'ofRoles',
                [[ChannelRole::INVENTORY_SUPPLY]]
            ],
            [
                ChannelChangeDescriptionAction::class,
                'ofDescription',
                [$this->getInstance(LocalizedString::class)]
            ],
            [
                ChannelChangeKeyAction::class,
                'ofKey',
                ['key']
            ],
            [
                ChannelChangeNameAction::class,
                'ofName',
                [$this->getInstance(LocalizedString::class)]
            ],
            [
                ChannelRemoveRolesAction::class,
                'ofRoles',
                [[ChannelRole::INVENTORY_SUPPLY]]
            ],
            [
                ChannelSetRolesAction::class,
                'ofRoles',
                [[ChannelRole::INVENTORY_SUPPLY]]
            ],
            [
                CustomerGroupChangeNameAction::class,
                'ofName',
                ['customerGroup']
            ],
            [
                SetCustomFieldAction::class,
                'ofName',
                ['fieldName']
            ],
            [
                SetCustomTypeAction::class,
                'ofTypeId',
                ['typeId']
            ],
            [
                SetCustomTypeAction::class,
                'ofTypeKey',
                ['typeKey']
            ],
            [
                SetCustomTypeAction::class,
                'ofType',
                [TypeReference::ofId('typeId')]
            ],
            [
                SetCustomTypeAction::class,
                'ofType',
                [TypeReference::ofKey('typeKey')]
            ],
            [
                ZoneAddLocationAction::class,
                'ofLocation',
                [$this->getInstance(Location::class)]
            ],
            [
                ZoneChangeNameAction::class,
                'ofName',
                ['newName']
            ],
            [
                ZoneRemoveLocationAction::class,
                'ofLocation',
                [$this->getInstance(Location::class)]
            ],
            [
                ZoneSetDescriptionAction::class,
                'of',
            ],
            [
                TaxCategoryAddTaxRateAction::class,
                'ofTaxRate',
                [$this->getInstance(TaxRate::class)]
            ],
            [
                TaxCategoryChangeNameAction::class,
                'ofName',
                ['newName']
            ],
            [
                TaxCategoryRemoveTaxRateAction::class,
                'ofTaxRateId',
                ['taxRateId']
            ],
            [
                TaxCategoryReplaceTaxRateAction::class,
                'ofTaxRateIdAndTaxRate',
                ['taxRateId', $this->getInstance(TaxRate::class)]
            ],
            [
                TaxCategorySetDescriptionAction::class,
                'of',
            ],
            [
                ReviewSetAuthorNameAction::class,
                'of',
            ],
            [
                ReviewSetCustomerAction::class,
                'of',
            ],
            [
                ReviewSetKeyAction::class,
                'of',
            ],
            [
                ReviewSetTargetAction::class,
                'of',
            ],
            [
                ReviewSetTextAction::class,
                'of',
            ],
            [
                ReviewSetTitleAction::class,
                'of',
            ],
            [
                ReviewTransitionStateAction::class,
                'ofState',
                [$this->getInstance(StateReference::class)]
            ],
            [
                TypeAddEnumValueAction::class,
                'ofNameAndEnum',
                ['fieldName', $this->getInstance(Enum::class)]
            ],
            [
                TypeAddFieldDefinitionAction::class,
                'ofFieldDefinition',
                [$this->getInstance(FieldDefinition::class)]
            ],
            [
                TypeAddLocalizedEnumValueAction::class,
                'ofNameAndEnum',
                ['fieldName', $this->getInstance(LocalizedEnum::class)]
            ],
            [
                TypeChangeEnumValueOrderAction::class,
                'ofNameAndEnums',
                ['fieldName', ['key1', 'key2']]
            ],
            [
                TypeChangeFieldDefinitionOrderAction::class,
                'ofFieldDefinitions',
                [['name1', 'name2']]
            ],
            [
                TypeChangeKeyAction::class,
                'ofKey',
                ['new-key']
            ],
            [
                TypeChangeLabelAction::class,
                'ofNameAndLabel',
                ['fieldName', $this->getInstance(LocalizedString::class)]
            ],
            [
                TypeChangeLocalizedEnumValueOrderAction::class,
                'ofNameAndEnums',
                ['fieldName', ['key1', 'key2']]
            ],
            [
                TypeChangeNameAction::class,
                'ofName',
                [$this->getInstance(LocalizedString::class)]
            ],
            [
                TypeRemoveFieldDefinitionAction::class,
                'ofFieldName',
                ['fieldName']
            ],
            [
                TypeSetDescriptionAction::class,
                'of',
            ],
            [
                StateAddRolesAction::class,
                'ofRoles',
                [['role1']]
            ],
            [
                StateChangeInitialAction::class,
                'ofInitial',
                [true]
            ],
            [
                StateChangeKeyAction::class,
                'ofKey',
                ['newKey']
            ],
            [
                StateChangeTypeAction::class,
                'ofType',
                ['newType']
            ],
            [
                StateRemoveRolesAction::class,
                'ofRoles',
                [['role1']]
            ],
            [
                StateSetDescriptionAction::class,
                'ofDescription',
                [$this->getInstance(LocalizedString::class)]
            ],
            [
                StateSetNameAction::class,
                'ofName',
                [$this->getInstance(LocalizedString::class)]
            ],
            [
                StateSetRolesAction::class,
                'ofRoles',
                [['role1']]
            ],
            [
                StateSetTransitionsAction::class,
                'ofTransitions',
                [$this->getInstance(StateReferenceCollection::class)]
            ],
            [
                TransitionStateAction::class,
                'ofState',
                [$this->getInstance(StateReference::class)]
            ],
            [
                DiscountCodeChangeCartDiscountsAction::class,
                'ofCartDiscountReferences',
                [$this->getInstance(CartDiscountReferenceCollection::class)]
            ],
            [
                DiscountCodeChangeCartDiscountsAction::class,
                'ofCartDiscountReference',
                [$this->getInstance(CartDiscountReference::class)]
            ],
            [
                DiscountCodeChangeIsActiveAction::class,
                'ofIsActive',
                [true]
            ],
            [
                DiscountCodeSetCartPredicateAction::class,
                'of',
            ],
            [
                DiscountCodeSetDescriptionAction::class,
                'of',
            ],
            [
                DiscountCodeSetMaxApplicationsAction::class,
                'of',
            ],
            [
                DiscountCodeSetMaxApplicationsPerCustomerAction::class,
                'of',
            ],
            [
                DiscountCodeSetNameAction::class,
                'of',
            ],
            [
                InventoryAddQuantityAction::class,
                'ofQuantity',
                [1]
            ],
            [
                InventoryChangeQuantityAction::class,
                'ofQuantity',
                [2]
            ],
            [
                InventoryRemoveQuantityAction::class,
                'ofQuantity',
                [3]
            ],
            [
                InventorySetExpectedDeliveryAction::class,
                'of',
            ],
            [
                InventorySetRestockableInDaysAction::class,
                'of',
            ],
            [
                InventorySetSupplyChannelAction::class,
                'of',
            ],
            [
                ProductDiscountChangeIsActiveAction::class,
                'ofIsActive',
                [true]
            ],
            [
                ProductDiscountChangeNameAction::class,
                'ofName',
                [$this->getInstance(LocalizedString::class)]
            ],
            [
                ProductDiscountChangePredicateAction::class,
                'ofPredicate',
                ['predicate']
            ],
            [
                ProductDiscountChangeSortOrderAction::class,
                'ofSortOrder',
                ['sortOrder']
            ],
            [
                ProductDiscountChangeValueAction::class,
                'ofProductDiscountValue',
                [$this->getInstance(ProductDiscountValue::class)]
            ],
            [
                ProductDiscountSetDescriptionAction::class,
                'of',
            ],
            [
                ShippingMethodAddShippingRateAction::class,
                'ofZoneAndShippingRate',
                [
                    $this->getInstance(ZoneReference::class),
                    $this->getInstance(ShippingRate::class)
                ]
            ],
            [
                ShippingMethodAddZoneAction::class,
                'ofZone',
                [$this->getInstance(ZoneReference::class)]
            ],
            [
                ShippingMethodChangeIsDefaultAction::class,
                'ofIsDefault',
                [true]
            ],
            [
                ShippingMethodChangeNameAction::class,
                'ofName',
                ['newName']
            ],
            [
                ShippingMethodChangeTaxCategoryAction::class,
                'ofTaxCategory',
                [$this->getInstance(TaxCategoryReference::class)]
            ],
            [
                ShippingMethodRemoveShippingRateAction::class,
                'ofZoneAndShippingRate',
                [
                    $this->getInstance(ZoneReference::class),
                    $this->getInstance(ShippingRate::class)
                ]
            ],
            [
                ShippingMethodRemoveZoneAction::class,
                'ofZone',
                [$this->getInstance(ZoneReference::class)]
            ],
            [
                ShippingMethodSetDescriptionAction::class,
                'of',
            ],
            [
                ProductTypeAddAttributeDefinitionAction::class,
                'ofAttribute',
                [$this->getInstance(AttributeDefinition::class)]
            ],
            [
                ProductTypeAddLocalizedEnumValueAction::class,
                'ofAttributeNameAndValue',
                [
                    'attributeName',
                    $this->getInstance(LocalizedEnum::class)
                ]
            ],
            [
                ProductTypeAddPlainEnumValueAction::class,
                'ofAttributeNameAndValue',
                [
                    'attributeName',
                    $this->getInstance(Enum::class)
                ]
            ],
            [
                ProductTypeChangeAttributeOrderAction::class,
                'ofAttributes',
                [$this->getInstance(AttributeDefinitionCollection::class)]
            ],
            [
                ProductTypeChangeDescriptionAction::class,
                'ofDescription',
                ['new description']
            ],
            [
                ProductTypeChangeIsSearchableAction::class,
                'ofAttributeNameAndIsSearchable',
                ['attributeName', true]
            ],
            [
                ProductTypeChangeLabelAction::class,
                'ofAttributeNameAndLabel',
                ['attributeName', $this->getInstance(LocalizedString::class)]
            ],
            [
                ProductTypeChangeLocalizedEnumValueOrderAction::class,
                'ofAttributeNameAndValues',
                ['attributeName', $this->getInstance(LocalizedEnumCollection::class)]
            ],
            [
                ProductTypeChangeNameAction::class,
                'ofName',
                ['new name']
            ],
            [
                ProductTypeChangePlainEnumValueOrderAction::class,
                'ofAttributeNameAndValues',
                ['attributeName', $this->getInstance(EnumCollection::class)]
            ],
            [
                ProductTypeRemoveAttributeDefinitionAction::class,
                'ofName',
                ['name']
            ],
            [
                ProductTypeSetInputTipAction::class,
                'ofAttributeName',
                ['attributeName']
            ],
            [
                ProductTypeSetKeyAction::class,
                'ofKey',
                ['typeKey']
            ],
            [
                PaymentAddInterfaceInteractionAction::class,
                'of',
            ],
            [
                PaymentAddTransactionAction::class,
                'ofTransaction',
                [$this->getInstance(Transaction::class)]
            ],
            [
                PaymentChangeAmountPlannedAction::class,
                'of',
            ],
            [
                PaymentChangeTransactionInteractionIdAction::class,
                'ofTransactionIdAndInteractionId',
                ['transactionId', 'interactionId']
            ],
            [
                PaymentChangeTransactionStateAction::class,
                'ofTransactionIdAndState',
                ['transactionId', 'state']
            ],
            [
                PaymentChangeTransactionTimestampAction::class,
                'ofTransactionIdAndTimestamp',
                ['transactionId', new \DateTime()]
            ],
            [
                PaymentSetAmountPaidAction::class,
                'of',
            ],
            [
                PaymentSetAmountRefundedAction::class,
                'of',
            ],
            [
                PaymentSetAuthorizationAction::class,
                'of',
            ],
            [
                PaymentSetCustomerAction::class,
                'of',
            ],
            [
                PaymentSetCustomFieldAction::class,
                'ofName',
                ['name']
            ],
            [
                PaymentSetCustomTypeAction::class,
                'of',
            ],
            [
                PaymentSetExternalIdAction::class,
                'of',
            ],
            [
                PaymentSetInterfaceIdAction::class,
                'ofInterfaceId',
                ['interfaceId']
            ],
            [
                PaymentSetMethodInfoInterfaceAction::class,
                'ofInterface',
                ['interface']
            ],
            [
                PaymentSetMethodInfoMethodAction::class,
                'of',
            ],
            [
                PaymentSetMethodInfoNameAction::class,
                'of',
            ],
            [
                PaymentSetStatusInterfaceCodeAction::class,
                'of',
            ],
            [
                PaymentSetStatusInterfaceTextAction::class,
                'of',
            ],
            [
                PaymentTransitionStateAction::class,
                'ofState',
                [$this->getInstance(StateReference::class)]
            ],
            [
                StoreSetNameAction::class,
                'ofName',
                [$this->getInstance(LocalizedString::class)]
            ],
        ];

        $actionNames = array_map(function ($value) {
            return $value[0] . '::' . $value[1];
        }, $actions);

        return array_combine($actionNames, $actions);
    }
}
