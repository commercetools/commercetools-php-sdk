<?php
/**
 *
 */

namespace Commercetools\Core\IntegrationTests\OrderEdit;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\Order\OrderUpdateRequestTest;
use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Model\Cart\ExternalTaxAmountDraft;
use Commercetools\Core\Model\Cart\ScoreShippingRateInput;
use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use Commercetools\Core\Model\Order\Order;
use Commercetools\Core\Model\Order\OrderReference;
use Commercetools\Core\Model\OrderEdit\OrderEdit;
use Commercetools\Core\Model\OrderEdit\OrderEditApplied;
use Commercetools\Core\Model\OrderEdit\OrderEditDraft;
use Commercetools\Core\Model\OrderEdit\OrderEditPreviewSuccess;
use Commercetools\Core\Model\ShippingMethod\ShippingRateDraft;
use Commercetools\Core\Model\TaxCategory\ExternalTaxRateDraft;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Request\AbstractDeleteRequest;
use Commercetools\Core\Request\OrderEdits\Command\OrderEditSetCommentAction;
use Commercetools\Core\Request\OrderEdits\Command\OrderEditSetCustomFieldAction;
use Commercetools\Core\Request\OrderEdits\Command\OrderEditSetCustomTypeAction;
use Commercetools\Core\Request\OrderEdits\Command\OrderEditSetKeyAction;
use Commercetools\Core\Request\OrderEdits\Command\OrderEditSetStagedActionsAction;
use Commercetools\Core\Request\OrderEdits\OrderEditCreateRequest;
use Commercetools\Core\Request\OrderEdits\OrderEditDeleteRequest;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderAddCustomLineItemAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderAddDiscountCodeAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderAddItemShippingAddressAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderAddLineItemAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderAddPaymentAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderAddShoppingListAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderChangeCustomLineItemMoneyAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderChangeCustomLineItemQuantityAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderChangeLineItemQuantityAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderChangeTaxCalculationModeAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderChangeTaxModeAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderChangeTaxRoundingModeAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderRemoveCustomLineItemAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderRemoveDiscountCodeAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderRemoveItemShippingAddressAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderRemoveLineItemAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderRemovePaymentAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetBillingAddressAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetCountryAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetCustomerEmailAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetCustomerGroupAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetCustomerIdAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetCustomFieldAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetCustomLineItemCustomFieldAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetCustomLineItemCustomTypeAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetCustomLineItemTaxAmountAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetCustomLineItemTaxRateAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetCustomShippingMethodAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetCustomTypeAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetLineItemCustomFieldAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetLineItemCustomTypeAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetLineItemPriceAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetLineItemShippingDetailsAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetLineItemTaxAmountAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetLineItemTaxRateAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetLineItemTotalPriceAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetLocaleAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetOrderTotalTaxAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetShippingAddressAction;
//phpcs:ignore
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetShippingAddressAndCustomShippingMethodAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetShippingAddressAndShippingMethodAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetShippingMethodAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetShippingMethodTaxAmountAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetShippingMethodTaxRateAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetShippingRateInputAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderUpdateActionCollection;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderUpdateItemShippingAddressAction;
use Commercetools\Core\Request\Orders\OrderByIdGetRequest;

class OrderEditUpdateRequestTest extends OrderUpdateRequestTest
{
    /** @var OrderEdit */
    protected $orderEdit;

    /** @var Order */
    protected $order;

    /**
     * @var AbstractDeleteRequest
     */
    protected $orderEditDeleteRequest;

    protected function getOrderEditDraft()
    {
        $cartDraft = $this->getCartDraft();
        $orderNumber = (new \DateTime())->format('Y/m/d') . ' ' . $this->getTestRun();
        $this->order = $this->createOrder($cartDraft, $orderNumber);

        $orderEditDraft = OrderEditDraft::ofResource(OrderReference::ofId($this->order->getId()));
        return $orderEditDraft;
    }

    protected function getOrderEdit(OrderEditDraft $draft = null)
    {
        if (is_null($this->orderEdit)) {
            if (is_null($draft)) {
                $draft = $this->getOrderEditDraft();
            }

            $request = OrderEditCreateRequest::ofDraft($draft);
            $response = $request->executeWithClient($this->getClient());
            $orderEdit = $request->mapResponse($response);

            $this->cleanupRequests[] = $this->orderEditDeleteRequest = OrderEditDeleteRequest::ofIdAndVersion(
                $orderEdit->getId(),
                $orderEdit->getVersion()
            );

            $this->orderEdit = $orderEdit;
        }

        return $this->orderEdit;
    }

    public function testOrderEditSetKey()
    {
        $orderEdit = $this->getOrderEdit();
        $this->assertInstanceOf(OrderEdit::class, $orderEdit);

        $newKey = 'foo-set-key-' . $this->getTestRun();
        $request = RequestBuilder::of()->orderEdits()->update($orderEdit)->setActions([
            OrderEditSetKeyAction::ofKey($newKey)
        ])->setDryRun(false);

        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->orderEditDeleteRequest->setVersion($result->getVersion());

        $this->assertNotSame($orderEdit->getVersion(), $result->getVersion());
        $this->assertInstanceOf(OrderEdit::class, $result);
        $this->assertSame($newKey, $result->getKey());
    }

    public function testUpdateOrderEditByKeySetComment()
    {
        $orderEditDraft = $this->getOrderEditDraft();
        $key = 'foo-set-key-comment-' . $this->getTestRun();
        $orderEditDraft->setKey($key);

        $orderEdit = $this->getOrderEdit($orderEditDraft);
        $this->assertNull($orderEdit->getComment());

        $request = RequestBuilder::of()->orderEdits()->updateByKey($orderEdit)->setActions([
            OrderEditSetCommentAction::of()->setComment('bar')
        ])->setDryRun(false);

        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->orderEditDeleteRequest->setVersion($result->getVersion());

        $this->assertNotSame($orderEdit->getVersion(), $result->getVersion());
        $this->assertInstanceOf(OrderEdit::class, $result);
        $this->assertSame('bar', $result->getComment());

        $request = RequestBuilder::of()->orderEdits()->getByKey($key);
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(OrderEdit::class, $result);
        $this->assertSame('bar', $result->getComment());
    }

    public function testUpdateOrderEditSetCustomType()
    {
        $typeKey = 'type-' . $this->getTestRun();
        $type = $this->getType($typeKey, 'order-edit');

        $orderEdit = $this->getOrderEdit();

        $request = RequestBuilder::of()->orderEdits()->update($orderEdit)->setActions([
            OrderEditSetCustomTypeAction::ofTypeKey($typeKey)
        ]);

        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(OrderEdit::class, $result);
        $this->assertSame($type->getId(), $result->getCustom()->getType()->getId());
        $this->assertNotSame($orderEdit->getVersion(), $result->getVersion());

        $this->orderEditDeleteRequest->setVersion($result->getVersion());
    }

    public function testUpdateOrderEditSetCustomField()
    {
        $typeKey = 'type-' . $this->getTestRun();
        $type = $this->getType($typeKey, 'order-edit');
        $fieldValue = $this->getTestRun() . '-new value';

        $orderEditDraft = $this->getOrderEditDraft();
        $orderEditDraft->setCustom(CustomFieldObjectDraft::of()->setType(TypeReference::ofKey($typeKey)));

        $orderEdit = $this->getOrderEdit($orderEditDraft);

        $request = RequestBuilder::of()->orderEdits()->update($orderEdit)->setActions([
            OrderEditSetCustomFieldAction::ofName('testField')->setValue($fieldValue)
        ]);
        $response = $request->executeWithClient($this->getClient());

        $result = $request->mapResponse($response);

        $this->assertInstanceOf(OrderEdit::class, $result);
        $this->assertSame($type->getId(), $result->getCustom()->getType()->getId());
        $this->assertSame($fieldValue, $result->getCustom()->getFields()->getTestField());
        $this->assertNotSame($orderEdit->getVersion(), $result->getVersion());

        $this->orderEditDeleteRequest->setVersion($result->getVersion());
    }

    public function testUpdateOrderEditSetStagedActions()
    {
        $orderEdit = $this->getOrderEdit();
        $this->assertInstanceOf(OrderEdit::class, $orderEdit);

        $request = RequestBuilder::of()->orderEdits()->update($orderEdit)->setActions([
            OrderEditSetStagedActionsAction::of()->setStagedActions(StagedOrderUpdateActionCollection::of()
                ->add(StagedOrderSetCountryAction::of()->setCountry('FR'))
                ->add(StagedOrderSetCustomerEmailAction::of()->setEmail('user@localhost')))
        ]);

        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->orderEditDeleteRequest->setVersion($result->getVersion());

        $this->assertNotSame($orderEdit->getVersion(), $result->getVersion());
        $this->assertInstanceOf(OrderEdit::class, $result);
        $stagedActions = $result->getStagedActions();

        $this->assertInstanceOf(StagedOrderUpdateActionCollection::class, $stagedActions);
        $this->assertCount(2, $stagedActions);

        $this->assertEquals(['action' => 'setCountry', 'country' => 'FR'], $stagedActions->current());
        $this->assertEquals(['action' => 'setCustomerEmail', 'email' => 'user@localhost'], $stagedActions->getAt(1));

        $this->assertInstanceOf(OrderEditPreviewSuccess::class, $result->getResult());
        /** @var Order $orderPreview */
        $orderPreview = $result->getResult()->getPreview();
        $this->assertInstanceOf(Order::class, $orderPreview);
        $this->assertSame('FR', $orderPreview->getCountry());
        $this->assertSame('user@localhost', $orderPreview->getCustomerEmail());
    }

    //phpcs:disable
    public function stagedActionsProvider()
    {
        return [
            StagedOrderSetCustomerEmailAction::class => [function () {return StagedOrderSetCustomerEmailAction::of()->setEmail('user@localhost'); } ],
            StagedOrderSetShippingAddressAction::class =>[function() { return StagedOrderSetShippingAddressAction::of()->setAddress(Address::of()->setCountry('DE')); }],
            StagedOrderSetBillingAddressAction::class => [function() { return StagedOrderSetBillingAddressAction::of()->setAddress(Address::of()->setCountry('DE')); }],
            StagedOrderSetCountryAction::class => [function() { return StagedOrderSetCountryAction::of()->setCountry('DE'); }],
            StagedOrderSetShippingMethodAction::class => [function() { return StagedOrderSetShippingMethodAction::of()->setShippingMethod($this->getShippingMethod()->getReference()); }],
            StagedOrderSetCustomShippingMethodAction::class => [function() { return StagedOrderSetCustomShippingMethodAction::of()
                ->setShippingMethodName($this->getTestRun() . '-name')
                ->setShippingRate(ShippingRateDraft::ofPrice(Money::ofCurrencyAndAmount('EUR', 100))); }],
            StagedOrderAddDiscountCodeAction::class => [function() { return StagedOrderAddDiscountCodeAction::of()->setCode($this->getDiscountCode()->getCode()); }],
            StagedOrderRemoveDiscountCodeAction::class => [function() {return StagedOrderRemoveDiscountCodeAction::of()->setDiscountCode($this->getDiscountCode()->getReference()); }],
            StagedOrderSetCustomerIdAction::class => [function() { return StagedOrderSetCustomerIdAction::of()->setCustomerId($this->getCustomer()->getId()); }],
            StagedOrderSetCustomerGroupAction::class => [function() { return StagedOrderSetCustomerGroupAction::of()->setCustomerGroup($this->getCustomerGroup()->getReference()); }],
            StagedOrderSetCustomTypeAction::class => [function() { return StagedOrderSetCustomTypeAction::of()
                ->setType($this->getType('order-edit-' . $this->getTestRun(), 'order-edit')->getReference()); }],
            StagedOrderSetCustomFieldAction::class => [function() { return StagedOrderSetCustomFieldAction::of()->setName($this->getTestRun() . '-name'); }],
            StagedOrderAddPaymentAction::class => [function() { return StagedOrderAddPaymentAction::of()->setPayment($this->getPayment()->getReference()); }],
            StagedOrderRemovePaymentAction::class => [function() { return StagedOrderRemovePaymentAction::of()->setPayment($this->getPayment()->getReference()); }],
            StagedOrderSetShippingMethodTaxAmountAction::class => [function() { return StagedOrderSetShippingMethodTaxAmountAction::of()->setExternalTaxAmount(
                ExternalTaxAmountDraft::ofTotalGrossAndTaxRate(
                    Money::ofCurrencyAndAmount('EUR', 100),
                    ExternalTaxRateDraft::ofNameCountryAndAmount($this->getTestRun() . '-name','DE',100.00)
                )
            ); }],
            StagedOrderSetShippingMethodTaxRateAction::class => [function() { return StagedOrderSetShippingMethodTaxRateAction::of()->setExternalTaxRate(
                ExternalTaxRateDraft::ofNameCountryAndAmount($this->getTestRun() . '-name', 'DE', 100.00)
            ); }],
            StagedOrderSetOrderTotalTaxAction::class => [function() { return StagedOrderSetOrderTotalTaxAction::of()
                ->setExternalTotalGross(Money::ofCurrencyAndAmount('EUR', 100)); }],
            StagedOrderChangeTaxModeAction::class => [function() { return StagedOrderChangeTaxModeAction::of()->setTaxMode(Cart::TAX_MODE_EXTERNAL_AMOUNT); }],
            StagedOrderSetLocaleAction::class => [function() { return StagedOrderSetLocaleAction::of()->setLocale('en'); }],
            StagedOrderChangeTaxRoundingModeAction::class => [function() { return StagedOrderChangeTaxRoundingModeAction::of()->setTaxRoundingMode(Cart::TAX_ROUNDING_MODE_HALF_EVEN); }],
            StagedOrderSetShippingRateInputAction::class => [function() { return StagedOrderSetShippingRateInputAction::of()->setShippingRateInput(
                ScoreShippingRateInput::ofScore(1)
            ); }],
            StagedOrderChangeTaxCalculationModeAction::class => [function() { return StagedOrderChangeTaxCalculationModeAction::of()
                ->setTaxCalculationMode(Cart::TAX_CALCULATION_MODE_LINE_ITEM_LEVEL); }],
            StagedOrderAddShoppingListAction::class => [function() { return StagedOrderAddShoppingListAction::of()->setShoppingList($this->getShoppingList()->getReference()); }],
            StagedOrderAddItemShippingAddressAction::class => [function() { return StagedOrderAddItemShippingAddressAction::of()->setAddress(Address::of()->setCountry('DE')); }],
            StagedOrderRemoveItemShippingAddressAction::class => [function() { return StagedOrderRemoveItemShippingAddressAction::of()
                ->setAddressKey($this->getTestRun() . '-key'); }],
            StagedOrderUpdateItemShippingAddressAction::class => [function() { return StagedOrderUpdateItemShippingAddressAction::of()
                ->setAddress(Address::of()->setCountry('DE')); }],
            StagedOrderSetShippingAddressAndShippingMethodAction::class => [function() { return StagedOrderSetShippingAddressAndShippingMethodAction::of()->setAddress(Address::of()->setCountry('DE')); }],
            StagedOrderSetShippingAddressAndCustomShippingMethodAction::class => [function() { return StagedOrderSetShippingAddressAndCustomShippingMethodAction::of()
                ->setAddress(Address::of()->setCountry('DE'))
                ->setShippingMethodName($this->getTestRun().'-name')
                ->setShippingRate(ShippingRateDraft::ofPrice(Money::ofCurrencyAndAmount('EUR', 100))); }],
            StagedOrderSetLineItemShippingDetailsAction::class => [function() { return StagedOrderSetLineItemShippingDetailsAction::of()->setLineItemId($this->getProduct()->getId()); }],

            //line items
            StagedOrderAddLineItemAction::class => [function() { return StagedOrderAddLineItemAction::of()->setSku($this->getTestRun() . '-sku'); }],
            StagedOrderRemoveLineItemAction::class => [function() { return StagedOrderRemoveLineItemAction::of()->setLineItemId($this->getProduct()->getId()); }],
            StagedOrderChangeLineItemQuantityAction::class => [function() { return StagedOrderChangeLineItemQuantityAction::of()
                ->setLineItemId($this->getProduct()->getId())->setQuantity(5); }],
            StagedOrderSetLineItemCustomTypeAction::class => [function() { return StagedOrderSetLineItemCustomTypeAction::of()->setLineItemId($this->getProduct()->getId()); }],
            StagedOrderSetLineItemCustomFieldAction::class => [function() { return StagedOrderSetLineItemCustomFieldAction::of()
                ->setLineItemId($this->getProduct()->getId())->setName($this->getTestRun().'-name'); }],
            StagedOrderSetLineItemTaxRateAction::class => [function() { return StagedOrderSetLineItemTaxRateAction::of()->setLineItemId($this->getProduct()->getId()); }],
            StagedOrderSetLineItemTaxAmountAction::class => [function() { return StagedOrderSetLineItemTaxAmountAction::of()->setLineItemId($this->getProduct()->getId()); }],
            StagedOrderSetLineItemTotalPriceAction::class => [function() { return StagedOrderSetLineItemTotalPriceAction::of()->setLineItemId($this->getProduct()->getId()); }],
            StagedOrderSetLineItemPriceAction::class => [function() { return StagedOrderSetLineItemPriceAction::of()->setLineItemId($this->getProduct()->getId()); }],

            //custom line items
            StagedOrderAddCustomLineItemAction::class => [function() { return StagedOrderAddCustomLineItemAction::of()
                ->setName(LocalizedString::ofLangAndText('en', $this->getTestRun().'-name'))
                ->setMoney(Money::ofCurrencyAndAmount('EUR', 100))
                ->setSlug($this->getTestRun().'-slug'); }],
            StagedOrderRemoveCustomLineItemAction::class => [function() { return StagedOrderRemoveCustomLineItemAction::of()->setCustomLineItemId($this->getProduct()->getId()); }],
            StagedOrderChangeCustomLineItemQuantityAction::class => [function() { return StagedOrderChangeCustomLineItemQuantityAction::of()
                ->setCustomLineItemId($this->getProduct()->getId())->setQuantity(10); }],
            StagedOrderSetCustomLineItemCustomTypeAction::class => [function() { return StagedOrderSetCustomLineItemCustomTypeAction::of()->setCustomLineItemId($this->getProduct()->getId()); }],
            StagedOrderSetCustomLineItemCustomFieldAction::class => [function() { return StagedOrderSetCustomLineItemCustomFieldAction::of()
                ->setCustomLineItemId($this->getProduct()->getId())->setName($this->getTestRun().'-name'); }],
            StagedOrderSetCustomLineItemTaxRateAction::class => [function() { return StagedOrderSetCustomLineItemTaxRateAction::of()->setCustomLineItemId($this->getProduct()->getId()); }],
            StagedOrderSetCustomLineItemTaxAmountAction::class => [function() { return StagedOrderSetCustomLineItemTaxAmountAction::of()->setCustomLineItemId($this->getProduct()->getId()); }],
            StagedOrderChangeCustomLineItemMoneyAction::class => [function() { return StagedOrderChangeCustomLineItemMoneyAction::of()
                ->setCustomLineItemId($this->getProduct()->getId())->setMoney(Money::ofCurrencyAndAmount('EUR', 100)); }],
        ];

    }
    //phpcs:enable

    /**
     * @dataProvider stagedActionsProvider
     */
    public function testOrderEditStagedActions($actionCallback)
    {
        $action = $actionCallback();
        $orderEdit = $this->getOrderEdit();

        $request = RequestBuilder::of()->orderEdits()->update($orderEdit)->setActions([
            OrderEditSetStagedActionsAction::of()->setStagedActions(
                StagedOrderUpdateActionCollection::of()->add($action)
            )
        ]);

        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->orderEditDeleteRequest->setVersion($result->getVersion());

        $this->assertNotSame($orderEdit->getVersion(), $result->getVersion());
        $this->assertInstanceOf(OrderEdit::class, $result);
        $this->assertInstanceOf(OrderEditPreviewSuccess::class, $orderEdit->getResult());

        $stagedActions = $result->getStagedActions();

        $this->assertInstanceOf(StagedOrderUpdateActionCollection::class, $stagedActions);
        $this->assertCount(1, $stagedActions);
        $this->assertSame($action->getAction(), $stagedActions->getAt(0)['action']);
    }

    public function testOrderEditApply()
    {
        $draft = $this->getOrderEditDraft();
        $draft->setStagedActions(
            StagedOrderUpdateActionCollection::of()
                ->add(StagedOrderSetCustomerEmailAction::of()->setEmail('user@localhost'))
        );

        $this->orderEdit = $this->getOrderEdit($draft);

        $request = RequestBuilder::of()->orderEdits()->apply($this->orderEdit, $this->order->getVersion());

        $response = $request->executeWithClient($this->getClient());
        $orderEdit = $request->mapResponse($response);

        $orderRequest = OrderByIdGetRequest::ofId($this->order->getId());
        $response = $orderRequest->executeWithClient($this->getClient());
        $order = $orderRequest->mapFromResponse($response);

        $this->deleteRequest->setVersion($order->getVersion());
        $this->orderEditDeleteRequest->setVersion($orderEdit->getVersion());

        $this->assertInstanceOf(OrderEdit::class, $orderEdit);
        $this->assertInstanceOf(OrderEditApplied::class, $orderEdit->getResult());
        $this->assertSame('user@localhost', $order->getCustomerEmail());
    }

    public function testUpdateOrderWithDryRun()
    {
        $orderEditDraft = $this->getOrderEditDraft();
        $orderEditDraft->setStagedActions(
            StagedOrderUpdateActionCollection::of()
                ->add(StagedOrderSetCustomerEmailAction::of()->setEmail('user@localhost'))
        );
        $orderEdit = $this->getOrderEdit($orderEditDraft);

        $request = RequestBuilder::of()->orderEdits()->update($orderEdit)->setActions([
            OrderEditSetCommentAction::of()->setComment('bar'),
            OrderEditSetStagedActionsAction::of()->setStagedActions(
                StagedOrderUpdateActionCollection::of()
                    ->add(StagedOrderSetCustomerEmailAction::of()->setEmail('user1@localhost1'))
            )
        ])->setDryRun(true);

        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertSame($orderEdit->getVersion(), $result->getVersion());
        $this->assertSame('bar', $result->getComment());

        $request = RequestBuilder::of()->orderEdits()->apply($this->orderEdit, $this->order->getVersion());

        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $orderRequest = OrderByIdGetRequest::ofId($this->order->getId());
        $response = $orderRequest->executeWithClient($this->getClient());
        $order = $orderRequest->mapFromResponse($response);

        $this->deleteRequest->setVersion($order->getVersion());
        $this->assertSame('user@localhost', $order->getCustomerEmail());

        $this->orderEditDeleteRequest->setVersion($result->getVersion());
        $this->assertInstanceOf(OrderEdit::class, $result);
        $this->assertNotSame($orderEdit->getVersion(), $result->getVersion());
        $this->assertNull($result->getComment());
        $this->assertInstanceOf(OrderEditApplied::class, $result->getResult());
    }
}
