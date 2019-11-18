<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\Cart;

use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Model\Cart\CartDraft;
use Commercetools\Core\Model\Cart\CartState;
use Commercetools\Core\Model\Cart\CustomLineItemDraft;
use Commercetools\Core\Model\Cart\CustomLineItemDraftCollection;
use Commercetools\Core\Model\Cart\ExternalLineItemTotalPrice;
use Commercetools\Core\Model\Cart\ExternalTaxAmountDraft;
use Commercetools\Core\Model\Cart\ItemShippingDetailsDraft;
use Commercetools\Core\Model\Cart\ItemShippingTarget;
use Commercetools\Core\Model\Cart\ItemShippingTargetCollection;
use Commercetools\Core\Model\Cart\LineItem;
use Commercetools\Core\Model\Cart\LineItemDraft;
use Commercetools\Core\Model\Cart\LineItemDraftCollection;
use Commercetools\Core\Model\Cart\ScoreShippingRateInput;
use Commercetools\Core\Model\CartDiscount\AbsoluteCartDiscountValue;
use Commercetools\Core\Model\CartDiscount\CartDiscountDraft;
use Commercetools\Core\Model\CartDiscount\CartDiscountTarget;
use Commercetools\Core\Model\CartDiscount\CartDiscountValue;
use Commercetools\Core\Model\CartDiscount\LineItemsTarget;
use Commercetools\Core\Model\CartDiscount\MultiBuyCustomLineItemsTarget;
use Commercetools\Core\Model\CartDiscount\MultiBuyLineItemsTarget;
use Commercetools\Core\Model\CartDiscount\RelativeCartDiscountValue;
use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\AddressCollection;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\MoneyCollection;
use Commercetools\Core\Model\Common\PriceDraft;
use Commercetools\Core\Model\Common\PriceTier;
use Commercetools\Core\Model\Common\PriceTierCollection;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use Commercetools\Core\Model\CustomField\FieldContainer;
use Commercetools\Core\Model\Project\CartScoreType;
use Commercetools\Core\Model\Project\Project;
use Commercetools\Core\Model\ShippingMethod\ShippingRate;
use Commercetools\Core\Model\Store\StoreReference;
use Commercetools\Core\Model\TaxCategory\ExternalTaxRateDraft;
use Commercetools\Core\Request\CartDiscounts\CartDiscountCreateRequest;
use Commercetools\Core\Request\Carts\CartByIdGetRequest;
use Commercetools\Core\Request\Carts\CartCreateRequest;
use Commercetools\Core\Request\Carts\CartDeleteRequest;
use Commercetools\Core\Request\Carts\CartQueryRequest;
use Commercetools\Core\Request\Carts\CartUpdateRequest;
use Commercetools\Core\Request\Carts\Command\CartAddCustomLineItemAction;
use Commercetools\Core\Request\Carts\Command\CartAddDiscountCodeAction;
use Commercetools\Core\Request\Carts\Command\CartAddItemShippingAddressAction;
use Commercetools\Core\Request\Carts\Command\CartAddLineItemAction;
use Commercetools\Core\Request\Carts\Command\CartAddPaymentAction;
use Commercetools\Core\Request\Carts\Command\CartApplyDeltaToCustomLineItemShippingDetailsTargetsAction;
use Commercetools\Core\Request\Carts\Command\CartApplyDeltaToLineItemShippingDetailsTargetsAction;
use Commercetools\Core\Request\Carts\Command\CartChangeCustomLineItemMoneyAction;
use Commercetools\Core\Request\Carts\Command\CartChangeCustomLineItemQuantityAction;
use Commercetools\Core\Request\Carts\Command\CartChangeLineItemQuantityAction;
use Commercetools\Core\Request\Carts\Command\CartChangeTaxCalculationModeAction;
use Commercetools\Core\Request\Carts\Command\CartChangeTaxRoundingModeAction;
use Commercetools\Core\Request\Carts\Command\CartRecalculateAction;
use Commercetools\Core\Request\Carts\Command\CartRemoveCustomLineItemAction;
use Commercetools\Core\Request\Carts\Command\CartRemoveDiscountCodeAction;
use Commercetools\Core\Request\Carts\Command\CartRemoveItemShippingAddressAction;
use Commercetools\Core\Request\Carts\Command\CartRemoveLineItemAction;
use Commercetools\Core\Request\Carts\Command\CartRemovePaymentAction;
use Commercetools\Core\Request\Carts\Command\CartSetAnonymousIdAction;
use Commercetools\Core\Request\Carts\Command\CartSetBillingAddressAction;
use Commercetools\Core\Request\Carts\Command\CartSetCartTotalTaxAction;
use Commercetools\Core\Request\Carts\Command\CartSetCountryAction;
use Commercetools\Core\Request\Carts\Command\CartSetCustomerEmailAction;
use Commercetools\Core\Request\Carts\Command\CartSetCustomerGroupAction;
use Commercetools\Core\Request\Carts\Command\CartSetCustomerIdAction;
use Commercetools\Core\Request\Carts\Command\CartSetCustomLineItemCustomFieldAction;
use Commercetools\Core\Request\Carts\Command\CartSetCustomLineItemCustomTypeAction;
use Commercetools\Core\Request\Carts\Command\CartSetCustomLineItemShippingDetailsAction;
use Commercetools\Core\Request\Carts\Command\CartSetCustomLineItemTaxAmountAction;
use Commercetools\Core\Request\Carts\Command\CartSetCustomShippingMethodAction;
use Commercetools\Core\Request\Carts\Command\CartSetDeleteDaysAfterLastModificationAction;
use Commercetools\Core\Request\Carts\Command\CartSetLineItemCustomFieldAction;
use Commercetools\Core\Request\Carts\Command\CartSetLineItemCustomTypeAction;
use Commercetools\Core\Request\Carts\Command\CartSetLineItemPriceAction;
use Commercetools\Core\Request\Carts\Command\CartSetLineItemShippingDetailsAction;
use Commercetools\Core\Request\Carts\Command\CartSetLineItemTaxAmountAction;
use Commercetools\Core\Request\Carts\Command\CartSetLineItemTotalPriceAction;
use Commercetools\Core\Request\Carts\Command\CartSetLocaleAction;
use Commercetools\Core\Request\Carts\Command\CartSetShippingAddressAction;
use Commercetools\Core\Request\Carts\Command\CartSetShippingMethodAction;
use Commercetools\Core\Request\Carts\Command\CartSetShippingMethodTaxAmountAction;
use Commercetools\Core\Request\Carts\Command\CartSetShippingRateInputAction;
use Commercetools\Core\Request\Carts\Command\CartUpdateItemShippingAddressAction;
use Commercetools\Core\Request\Customers\CustomerLoginRequest;
use Commercetools\Core\Request\CustomField\Command\SetCustomFieldAction;
use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;
use Commercetools\Core\Request\InStores\InStoreRequestDecorator;
use Commercetools\Core\Request\Products\Command\ProductChangeNameAction;
use Commercetools\Core\Request\Products\Command\ProductChangePriceAction;
use Commercetools\Core\Request\Products\Command\ProductPublishAction;
use Commercetools\Core\Request\Products\ProductUpdateRequest;
use Commercetools\Core\Request\Project\Command\ProjectSetShippingRateInputTypeAction;
use Commercetools\Core\Request\Project\ProjectGetRequest;
use Commercetools\Core\Request\Project\ProjectUpdateRequest;
use Commercetools\Core\IntegrationTests\TestHelper;

class CartUpdateRequestTest extends ApiTestCase
{
    public function testLineItemsOfRemovedProducts()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $product = $this->getProduct();
        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartAddLineItemAction::ofProductIdVariantIdAndQuantity($product->getId(), $variant->getId(), 1)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertFalse($response->isError());

        $this->deleteProduct();

        $request = CartByIdGetRequest::ofId($cart->getId());
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->assertNotEmpty($cart->getLineItems());

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(CartRecalculateAction::of())
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        if (!$response->isError()) {
            $this->deleteRequest->setVersion($result->getVersion());
            $this->markTestSkipped('Recalculation for removed products not erroring anymore');
        }
        $this->assertTrue($response->isError());

        $request = CartByIdGetRequest::ofId($cart->getId());
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);

        $lineItem = $cart->getLineItems()->current()->getId();
        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(CartRemoveLineItemAction::ofLineItemId($lineItem))
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertFalse($response->isError());
        $this->assertEmpty($cart->getLineItems());

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(CartRecalculateAction::of())
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());
        $this->assertFalse($response->isError());
    }

    public function testLineItem()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $product = $this->getProduct();
        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartAddLineItemAction::ofProductIdVariantIdAndQuantity($product->getId(), $variant->getId(), 1)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($product->getId(), $cart->getLineItems()->current()->getProductId());
        $this->assertSame(
            $product->getProductType()->getId(),
            $cart->getLineItems()->current()->getProductType()->getId()
        );
        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartChangeLineItemQuantityAction::ofLineItemIdAndQuantity($cart->getLineItems()->current()->getId(), 2)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame(2, $cart->getLineItems()->current()->getQuantity());

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartRemoveLineItemAction::ofLineItemId($cart->getLineItems()->current()->getId())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertCount(0, $cart->getLineItems());
    }

    public function testLineItemBySku()
    {
        $product = $this->getProduct();
        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();

        $draft = $this->getDraft();
        $draft->setLineItems(LineItemDraftCollection::of()->add(LineItemDraft::ofSku($variant->getSku())));
        $cart = $this->createCart($draft);

        $this->assertSame(1, $cart->getLineItems()->current()->getQuantity());
        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartAddLineItemAction::ofSkuAndQuantity($variant->getSku(), 1)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame(2, $cart->getLineItems()->current()->getQuantity());
    }

    public function testSetExternalLineItemTotalPrice()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $product = $this->getProduct();
        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartAddLineItemAction::ofProductIdVariantIdAndQuantity($product->getId(), $variant->getId(), 1)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($product->getId(), $cart->getLineItems()->current()->getProductId());
        $this->assertSame(LineItem::PRICE_MODE_PLATFORM, $cart->getLineItems()->current()->getPriceMode());
        $this->assertSame(100, $cart->getLineItems()->current()->getPrice()->getValue()->getCentAmount());
        $this->assertSame(100, $cart->getLineItems()->current()->getTotalPrice()->getCentAmount());

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartSetLineItemTotalPriceAction::ofLineItemId($cart->getLineItems()->current()->getId())
                    ->setExternalTotalPrice(
                        ExternalLineItemTotalPrice::of()
                            ->setPrice(Money::ofCurrencyAndAmount('EUR', 12345))
                            ->setTotalPrice(Money::ofCurrencyAndAmount('EUR', 12345678))
                    )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame(LineItem::PRICE_MODE_EXTERNAL_TOTAL, $cart->getLineItems()->current()->getPriceMode());
        $this->assertSame(12345, $cart->getLineItems()->current()->getPrice()->getValue()->getCentAmount());
        $this->assertSame(12345678, $cart->getLineItems()->current()->getTotalPrice()->getCentAmount());

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartSetLineItemTotalPriceAction::ofLineItemId($cart->getLineItems()->current()->getId())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame(LineItem::PRICE_MODE_PLATFORM, $cart->getLineItems()->current()->getPriceMode());
        $this->assertSame(100, $cart->getLineItems()->current()->getPrice()->getValue()->getCentAmount());
        $this->assertSame(100, $cart->getLineItems()->current()->getTotalPrice()->getCentAmount());
    }

    public function testSetExternalLineItemPrice()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $product = $this->getProduct();
        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartAddLineItemAction::ofProductIdVariantIdAndQuantity($product->getId(), $variant->getId(), 2)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($product->getId(), $cart->getLineItems()->current()->getProductId());
        $this->assertSame(LineItem::PRICE_MODE_PLATFORM, $cart->getLineItems()->current()->getPriceMode());
        $this->assertSame(100, $cart->getLineItems()->current()->getPrice()->getValue()->getCentAmount());
        $this->assertSame(200, $cart->getLineItems()->current()->getTotalPrice()->getCentAmount());

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartSetLineItemPriceAction::ofLineItemId($cart->getLineItems()->current()->getId())
                    ->setExternalPrice(Money::ofCurrencyAndAmount('EUR', 12345))
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame(LineItem::PRICE_MODE_EXTERNAL_PRICE, $cart->getLineItems()->current()->getPriceMode());
        $this->assertSame(12345, $cart->getLineItems()->current()->getPrice()->getValue()->getCentAmount());
        $this->assertSame(24690, $cart->getLineItems()->current()->getTotalPrice()->getCentAmount());

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartSetLineItemPriceAction::ofLineItemId($cart->getLineItems()->current()->getId())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame(LineItem::PRICE_MODE_PLATFORM, $cart->getLineItems()->current()->getPriceMode());
        $this->assertSame(100, $cart->getLineItems()->current()->getPrice()->getValue()->getCentAmount());
        $this->assertSame(200, $cart->getLineItems()->current()->getTotalPrice()->getCentAmount());
    }

    public function testUnsetExternalLineItemTotalPriceQuantityChange()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $product = $this->getProduct();
        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartAddLineItemAction::ofProductIdVariantIdAndQuantity($product->getId(), $variant->getId(), 1)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($product->getId(), $cart->getLineItems()->current()->getProductId());
        $this->assertSame(LineItem::PRICE_MODE_PLATFORM, $cart->getLineItems()->current()->getPriceMode());
        $this->assertSame(100, $cart->getLineItems()->current()->getPrice()->getValue()->getCentAmount());
        $this->assertSame(100, $cart->getLineItems()->current()->getTotalPrice()->getCentAmount());

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartSetLineItemTotalPriceAction::ofLineItemId($cart->getLineItems()->current()->getId())
                    ->setExternalTotalPrice(
                        ExternalLineItemTotalPrice::of()
                            ->setPrice(Money::ofCurrencyAndAmount('EUR', 12345))
                            ->setTotalPrice(Money::ofCurrencyAndAmount('EUR', 12345678))
                    )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame(LineItem::PRICE_MODE_EXTERNAL_TOTAL, $cart->getLineItems()->current()->getPriceMode());
        $this->assertSame(12345, $cart->getLineItems()->current()->getPrice()->getValue()->getCentAmount());
        $this->assertSame(12345678, $cart->getLineItems()->current()->getTotalPrice()->getCentAmount());

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartChangeLineItemQuantityAction::ofLineItemIdAndQuantity($cart->getLineItems()->current()->getId(), 2)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame(LineItem::PRICE_MODE_PLATFORM, $cart->getLineItems()->current()->getPriceMode());
        $this->assertSame(100, $cart->getLineItems()->current()->getPrice()->getValue()->getCentAmount());
        $this->assertSame(200, $cart->getLineItems()->current()->getTotalPrice()->getCentAmount());
    }

    public function testExternalLineItemTotalPriceQuantityChange()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $product = $this->getProduct();
        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartAddLineItemAction::ofProductIdVariantIdAndQuantity($product->getId(), $variant->getId(), 2)
                    ->setExternalTotalPrice(
                        ExternalLineItemTotalPrice::of()
                            ->setPrice(Money::ofCurrencyAndAmount('EUR', 12345))
                            ->setTotalPrice(Money::ofCurrencyAndAmount('EUR', 12345678))
                    )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($product->getId(), $cart->getLineItems()->current()->getProductId());
        $this->assertSame(LineItem::PRICE_MODE_EXTERNAL_TOTAL, $cart->getLineItems()->current()->getPriceMode());
        $this->assertSame(12345, $cart->getLineItems()->current()->getPrice()->getValue()->getCentAmount());
        $this->assertSame(12345678, $cart->getLineItems()->current()->getTotalPrice()->getCentAmount());

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartChangeLineItemQuantityAction::ofLineItemIdAndQuantity($cart->getLineItems()->current()->getId(), 3)
                    ->setExternalTotalPrice(
                        ExternalLineItemTotalPrice::of()
                            ->setPrice(Money::ofCurrencyAndAmount('EUR', 12345))
                            ->setTotalPrice(Money::ofCurrencyAndAmount('EUR', 12345679))
                    )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame(LineItem::PRICE_MODE_EXTERNAL_TOTAL, $cart->getLineItems()->current()->getPriceMode());
        $this->assertSame(12345, $cart->getLineItems()->current()->getPrice()->getValue()->getCentAmount());
        $this->assertSame(12345679, $cart->getLineItems()->current()->getTotalPrice()->getCentAmount());
    }

    public function testExternalLineItemPriceQuantityChange()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $product = $this->getProduct();
        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartAddLineItemAction::ofProductIdVariantIdAndQuantity($product->getId(), $variant->getId(), 2)
                    ->setExternalPrice(Money::ofCurrencyAndAmount('EUR', 12345))
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($product->getId(), $cart->getLineItems()->current()->getProductId());
        $this->assertSame(LineItem::PRICE_MODE_EXTERNAL_PRICE, $cart->getLineItems()->current()->getPriceMode());
        $this->assertSame(12345, $cart->getLineItems()->current()->getPrice()->getValue()->getCentAmount());
        $this->assertSame(24690, $cart->getLineItems()->current()->getTotalPrice()->getCentAmount());

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartChangeLineItemQuantityAction::ofLineItemIdAndQuantity($cart->getLineItems()->current()->getId(), 3)
                    ->setExternalPrice(Money::ofCurrencyAndAmount('EUR', 12345))
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame(LineItem::PRICE_MODE_EXTERNAL_PRICE, $cart->getLineItems()->current()->getPriceMode());
        $this->assertSame(12345, $cart->getLineItems()->current()->getPrice()->getValue()->getCentAmount());
        $this->assertSame(37035, $cart->getLineItems()->current()->getTotalPrice()->getCentAmount());
    }

    public function testCustomLineItem()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $name = LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun());

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartAddCustomLineItemAction::ofNameQuantityMoneySlugAndTaxCategory(
                    $name,
                    1,
                    Money::ofCurrencyAndAmount('EUR', 100),
                    $name->en,
                    $this->getTaxCategory()->getReference()
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($name->en, $cart->getCustomLineItems()->current()->getName()->en);

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartRemoveCustomLineItemAction::ofCustomLineItemId($cart->getCustomLineItems()->current()->getId())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertCount(0, $cart->getLineItems());
    }

    public function testCustomLineItemChangeQuantity()
    {
        $name = LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun());

        $draft = $this->getDraft();
        $draft->setCustomLineItems(
            CustomLineItemDraftCollection::of()
                ->add(
                    CustomLineItemDraft::ofNameMoneySlugAndTaxCategory(
                        $name,
                        Money::ofCurrencyAndAmount('EUR', 100),
                        $name->en,
                        $this->getTaxCategory()->getReference()
                    )->setQuantity(1)
                )
        );
        $cart = $this->createCart($draft);

        $this->assertSame(100, $cart->getCustomLineItems()->current()->getTotalPrice()->getCentAmount());
        $this->assertSame(100, $cart->getTotalPrice()->getCentAmount());

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartChangeCustomLineItemQuantityAction::ofCustomLineItemIdAndQuantity(
                    $cart->getCustomLineItems()->current()->getId(),
                    2
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame(2, $cart->getCustomLineItems()->current()->getQuantity());
        $this->assertSame(200, $cart->getCustomLineItems()->current()->getTotalPrice()->getCentAmount());
        $this->assertSame(200, $cart->getTotalPrice()->getCentAmount());
    }

    public function testCustomLineItemChangeMoney()
    {
        $name = LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun());

        $draft = $this->getDraft();
        $draft->setCustomLineItems(
            CustomLineItemDraftCollection::of()
                ->add(
                    CustomLineItemDraft::ofNameMoneySlugAndTaxCategory(
                        $name,
                        Money::ofCurrencyAndAmount('EUR', 100),
                        $name->en,
                        $this->getTaxCategory()->getReference()
                    )->setQuantity(2)
                )
        );
        $cart = $this->createCart($draft);

        $this->assertSame(100, $cart->getCustomLineItems()->current()->getMoney()->getCentAmount());
        $this->assertSame(200, $cart->getCustomLineItems()->current()->getTotalPrice()->getCentAmount());
        $this->assertSame(200, $cart->getTotalPrice()->getCentAmount());


        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartChangeCustomLineItemMoneyAction::ofCustomLineItemIdAndMoney(
                    $cart->getCustomLineItems()->current()->getId(),
                    Money::ofCurrencyAndAmount('EUR', 200)
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());

        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame(2, $cart->getCustomLineItems()->current()->getQuantity());
        $this->assertSame(200, $cart->getCustomLineItems()->current()->getMoney()->getCentAmount());
        $this->assertSame(400, $cart->getCustomLineItems()->current()->getTotalPrice()->getCentAmount());
        $this->assertSame(400, $cart->getTotalPrice()->getCentAmount());
    }

    public function testCustomLineItemMerge()
    {
        $name = LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun());
        $anonName = LocalizedString::ofLangAndText('en', 'anon-' . $this->getTestRun());
        $customerDraft = $this->getCustomerDraft();
        $customer = $this->getCustomer($customerDraft);

        $draft = $this->getDraft();
        $draft->setCustomerId($customer->getId());
        $customerCart = $this->createCart($draft);

        $this->assertCount(0, $customerCart->getCustomLineItems());

        $anonCartDraft = $this->getDraft();
        $anonCartDraft->setCustomLineItems(
            CustomLineItemDraftCollection::of()
                ->add(
                    CustomLineItemDraft::ofNameMoneySlugAndTaxCategory(
                        $anonName,
                        Money::ofCurrencyAndAmount('EUR', 100),
                        $anonName->en,
                        $this->getTaxCategory()->getReference()
                    )->setQuantity(1)
                )
        );
        $request = CartCreateRequest::ofDraft($anonCartDraft);
        $response = $request->executeWithClient($this->getClient());
        $anonCart = $request->mapResponse($response);
        $this->assertSame(CartState::ACTIVE, $anonCart->getCartState());

        $this->assertNotSame($customerCart->getId(), $anonCart->getId());

        $loginRequest = CustomerLoginRequest::ofEmailAndPassword(
            $customerDraft->getEmail(),
            $customerDraft->getPassword(),
            $anonCart->getId()
        );
        $response = $loginRequest->executeWithClient($this->getClient());
        $result = $loginRequest->mapResponse($response);
        $loginCart = $result->getCart();
        $this->assertSame(CartState::ACTIVE, $loginCart->getCartState());

        if ($loginCart->getCustomLineItems()->count() == 0) {
            $this->markTestSkipped(
                'Merging custom line items from anon carts to customer cart not yet supported by API.'
            );
        }
        $this->assertCount(1, $loginCart->getCustomLineItems());
        $this->assertSame($anonName->en, $loginCart->getCustomLineItems()->current()->getSlug());

        $anonCartRequest = CartByIdGetRequest::ofId($anonCart->getId());
        $response = $anonCartRequest->executeWithClient($this->getClient());
        $anonCart = $request->mapResponse($response);

        $customerCartRequest = CartByIdGetRequest::ofId($anonCart->getId());
        $response = $customerCartRequest->executeWithClient($this->getClient());
        $customerCart = $request->mapResponse($response);

        $this->deleteRequest->setVersion($customerCart->getVersion());
        $this->cleanupRequests[] = CartDeleteRequest::ofIdAndVersion($anonCart->getId(), $anonCart->getVersion());

        $this->assertSame(CartState::MERGED, $anonCart->getCartState());
    }

    public function testCustomerEmail()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $email = 'test-' . $this->getTestRun() . '@example.com';

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(CartSetCustomerEmailAction::of()->setEmail($email))
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($email, $cart->getCustomerEmail());
    }

    public function testShippingAddress()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $address = Address::of()
            ->setFirstName('test-' . $this->getTestRun() . '@example.com')
            ->setCountry('DE')
        ;

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(CartSetShippingAddressAction::of()->setAddress($address))
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($address->getFirstName(), $cart->getShippingAddress()->getFirstName());
    }

    public function testBillingAddress()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $address = Address::of()
            ->setFirstName('test-' . $this->getTestRun() . '@example.com')
            ->setCountry('DE')
        ;

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(CartSetBillingAddressAction::of()->setAddress($address))
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($address->getFirstName(), $cart->getBillingAddress()->getFirstName());
    }

    public function testSetCountry()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $country = 'UK';

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(CartSetCountryAction::of()->setCountry($country))
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($country, $cart->getCountry());
    }

    public function testSetAnonymousId()
    {
        $anonymousId = uniqid();
        $draft = $this->getDraft();
        $draft->setAnonymousId($anonymousId);
        $cart = $this->createCart($draft);
        $this->assertSame($anonymousId, $cart->getAnonymousId());

        $newAnonymousId = uniqid();

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(CartSetAnonymousIdAction::of()->setAnonymousId($newAnonymousId))
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($newAnonymousId, $cart->getAnonymousId());

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(CartSetAnonymousIdAction::of())
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertNull($cart->getAnonymousId());
    }

    public function testSetShippingMethod()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $shippingMethod = $this->getShippingMethod();
        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartSetShippingAddressAction::of()->setAddress(
                    Address::of()->setCountry('DE')->setState($this->getRegion())
                )
            )
            ->addAction(
                CartSetShippingMethodAction::of()->setShippingMethod($shippingMethod->getReference())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($shippingMethod->getName(), $cart->getShippingInfo()->getShippingMethodName());
    }

    public function testSetCustomShippingMethod()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $shippingMethod = 'test-' . $this->getTestRun();
        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartSetShippingAddressAction::of()->setAddress(
                    Address::of()->setCountry('DE')->setState($this->getRegion())
                )
            )
            ->addAction(
                CartSetCustomShippingMethodAction::of()->setShippingMethodName($shippingMethod)
                    ->setShippingRate(ShippingRate::of()->setPrice(Money::ofCurrencyAndAmount('EUR', 100)))
                    ->setTaxCategory($this->getTaxCategory()->getReference())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($shippingMethod, $cart->getShippingInfo()->getShippingMethodName());
    }

    public function testCustomerId()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $customer = $this->getCustomer();
        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(CartSetCustomerIdAction::of()->setCustomerId($customer->getId()))
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($customer->getId(), $cart->getCustomerId());
    }

    public function testRecalculate()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $product = $this->getProduct();
        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartAddLineItemAction::ofProductIdVariantIdAndQuantity($product->getId(), $variant->getId(), 1)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductChangePriceAction::ofPriceIdAndPrice(
                    $variant->getPrices()->current()->getId(),
                    PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 200))
                )
            )
            ->addAction(ProductPublishAction::of())
        ;
        $response = $request->executeWithClient($this->getClient());
        TestHelper::getInstance($this->getClient())->setProduct($request->mapResponse($response));

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(CartRecalculateAction::of())
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame(200, $cart->getTotalPrice()->getCentAmount());
    }

    public function testRecalculateChangedProduct()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $product = $this->getProduct();
        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartAddLineItemAction::ofProductIdVariantIdAndQuantity($product->getId(), $variant->getId(), 1)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $request = CartQueryRequest::of()->where('id = "' . $cart->getId() . '"')->limit(1);
        $response = $request->executeWithClient($this->getClient());

        $cart2 = $request->mapResponse($response)->current();
        $this->assertNotEmpty((string)$cart2->getLineItems()->current()->getProductSlug());

        $newName = 'new-name-' . $this->getTestRun();
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductChangeNameAction::ofName(
                    LocalizedString::ofLangAndText('en', $newName)
                )
            )
            ->addAction(ProductPublishAction::of())
        ;
        $response = $request->executeWithClient($this->getClient());
        TestHelper::getInstance($this->getClient())->setProduct($request->mapResponse($response));

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(CartRecalculateAction::of())
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame(100, $cart->getTotalPrice()->getCentAmount());
        $this->assertSame(
            (string)$product->getMasterData()->getCurrent()->getName(),
            (string)$cart->getLineItems()->current()->getName()
        );

        $this->assertNotEmpty((string)$cart->getLineItems()->current()->getProductSlug());

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(CartRecalculateAction::of()->setUpdateProductData(true))
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame(100, $cart->getTotalPrice()->getCentAmount());
        $this->assertSame($newName, (string)$cart->getLineItems()->current()->getName());
        $this->assertNotEmpty((string)$cart->getLineItems()->current()->getProductSlug());
    }

    public function testCustomType()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $type = $this->getType('key-' . $this->getTestRun(), 'order');

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                SetCustomTypeAction::ofTypeKey($type->getKey())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($type->getId(), $cart->getCustom()->getType()->getId());
    }

    public function testCustomField()
    {
        $type = $this->getType('key-' . $this->getTestRun(), 'order');
        $draft = $this->getDraft();
        $draft->setCustom(CustomFieldObjectDraft::ofType($type->getReference()));
        $cart = $this->createCart($draft);


        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                SetCustomFieldAction::ofName('testField')
                    ->setValue($this->getTestRun())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($this->getTestRun(), $cart->getCustom()->getFields()->getTestField());
    }

    public function testLineItemCustomType()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $type = $this->getType('key-' . $this->getTestRun(), 'line-item');
        $product = $this->getProduct();
        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartAddLineItemAction::ofProductIdVariantIdAndQuantity($product->getId(), $variant->getId(), 1)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartSetLineItemCustomTypeAction::ofTypeKey($type->getKey())
                    ->setLineItemId($cart->getLineItems()->current()->getId())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($type->getId(), $cart->getLineItems()->current()->getCustom()->getType()->getId());
    }

    public function testAddLineItemWithCustomType()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $type = $this->getType('key-' . $this->getTestRun(), 'line-item');
        $product = $this->getProduct();
        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartAddLineItemAction::ofProductIdVariantIdAndQuantity($product->getId(), $variant->getId(), 1)
                    ->setCustom(
                        CustomFieldObjectDraft::ofTypeKey($type->getKey())
                            ->setFields(
                                FieldContainer::of()
                                    ->setTestField('1')
                            )
                    )
            )
            ->addAction(
                CartAddLineItemAction::ofProductIdVariantIdAndQuantity($product->getId(), $variant->getId(), 1)
                    ->setCustom(
                        CustomFieldObjectDraft::ofTypeKey($type->getKey())
                            ->setFields(
                                FieldContainer::of()
                                    ->setTestField('2')
                            )
                    )
            )
        ;

        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertCount(2, $cart->getLineItems());
        $this->assertSame(1, $cart->getLineItems()->getAt(0)->getQuantity());
        $this->assertSame(1, $cart->getLineItems()->getAt(1)->getQuantity());
    }

    public function testCustomLineItemCustomType()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $type = $this->getType('key-' . $this->getTestRun(), 'custom-line-item');

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartAddCustomLineItemAction::ofNameQuantityMoneySlugAndTaxCategory(
                    LocalizedString::ofLangAndText('en', 'item-' . $this->getTestRun()),
                    1,
                    Money::ofCurrencyAndAmount('EUR', 100),
                    'item-' . $this->getTestRun(),
                    $this->getTaxCategory()->getReference()
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartSetCustomLineItemCustomTypeAction::ofTypeKey($type->getKey())
                    ->setCustomLineItemId($cart->getCustomLineItems()->current()->getId())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($type->getId(), $cart->getCustomLineItems()->current()->getCustom()->getType()->getId());
    }

    public function testLineItemCustomField()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $type = $this->getType('key-' . $this->getTestRun(), 'line-item');
        $product = $this->getProduct();
        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartAddLineItemAction::ofProductIdVariantIdAndQuantity($product->getId(), $variant->getId(), 1)
                    ->setCustom(CustomFieldObjectDraft::ofType($type->getReference()))
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartSetLineItemCustomFieldAction::ofName('testField')
                    ->setLineItemId($cart->getLineItems()->current()->getId())
                    ->setValue($this->getTestRun())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame(
            $this->getTestRun(),
            $cart->getLineItems()->current()->getCustom()->getFields()->getTestField()
        );
    }

    public function testCustomLineItemCustomField()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $type = $this->getType('key-' . $this->getTestRun(), 'custom-line-item');

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartAddCustomLineItemAction::ofNameQuantityMoneySlugAndTaxCategory(
                    LocalizedString::ofLangAndText('en', 'item-' . $this->getTestRun()),
                    1,
                    Money::ofCurrencyAndAmount('EUR', 100),
                    'item-' . $this->getTestRun(),
                    $this->getTaxCategory()->getReference()
                )
                    ->setCustom(CustomFieldObjectDraft::ofType($type->getReference()))
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartSetCustomLineItemCustomFieldAction::ofName('testField')
                    ->setCustomLineItemId($cart->getCustomLineItems()->current()->getId())
                    ->setValue($this->getTestRun())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame(
            $this->getTestRun(),
            $cart->getCustomLineItems()->current()->getCustom()->getFields()->getTestField()
        );
    }

    public function testPayment()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $payment = $this->getPayment();

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(CartAddPaymentAction::of()->setPayment($payment->getReference()))
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($payment->getId(), $cart->getPaymentInfo()->getPayments()->current()->getId());
        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(CartRemovePaymentAction::of()->setPayment($payment->getReference()))
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());
        $this->assertNull($cart->getPaymentInfo());
    }

    public function testDiscountCode()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $discountCode = $this->getDiscountCode();

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(CartAddDiscountCodeAction::ofCode($discountCode->getCode()))
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($discountCode->getId(), $cart->getDiscountCodes()->current()->getDiscountCode()->getId());

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(CartRemoveDiscountCodeAction::ofDiscountCode($discountCode->getReference()))
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());
        $this->assertEmpty($cart->getDiscountCodes());
    }

    public function testDiscountCodeCustomPredicate()
    {
        $type = $this->getType('key-' . $this->getTestRun(), 'order');
        $draft = $this->getDraft();
        $draft->setCustom(
            CustomFieldObjectDraft::ofType($type->getReference())
                ->setFields(FieldContainer::of()->set('testField', $this->getTestRun()))
        );
        $draft->setLineItems(
            LineItemDraftCollection::of()
                ->add(LineItemDraft::of()->setProductId($this->getProduct()->getId())->setVariantId(1)->setQuantity(1))
        );

        $cart = $this->createCart($draft);

        $draft = CartDiscountDraft::ofNameValuePredicateTargetOrderActiveAndDiscountCode(
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-discount'),
            AbsoluteCartDiscountValue::of()->setMoney(
                MoneyCollection::of()->add(Money::ofCurrencyAndAmount('EUR', 100))
            ),
            'custom.testField = "' . $this->getTestRun() . '"',
            LineItemsTarget::of()->setPredicate('1=1'),
            '0.9' . trim((string)mt_rand(1, TestHelper::RAND_MAX), '0'),
            true,
            true
        );
        $request = CartDiscountCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $cartDiscount = $request->mapFromResponse($response);
        TestHelper::getInstance($this->getClient())->setCartDiscount($cartDiscount);
        $discountCode = $this->getDiscountCode();

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(CartAddDiscountCodeAction::ofCode($discountCode->getCode()))
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($discountCode->getId(), $cart->getDiscountCodes()->current()->getDiscountCode()->getId());

        $this->assertSame(
            $cartDiscount->getId(),
            $cart->getLineItems()->current()
                ->getDiscountedPricePerQuantity()->current()
                ->getDiscountedPrice()->getIncludedDiscounts()->current()
                ->getDiscount()->getId()
        );
    }

    public function testMultiBuyDiscount()
    {
        $draft = $this->getDraft();
        $draft->setLineItems(
            LineItemDraftCollection::of()
                ->add(LineItemDraft::of()->setProductId($this->getProduct()->getId())->setVariantId(1)->setQuantity(3))
        );

        $cart = $this->createCart($draft);

        $draft = CartDiscountDraft::ofNameValuePredicateTargetOrderActiveAndDiscountCode(
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-discount'),
            RelativeCartDiscountValue::of()->setPermyriad(10000),
            '1=1',
            MultiBuyLineItemsTarget::ofPredicateTriggerDiscountedAndMode(
                '1=1',
                3,
                1,
                MultiBuyLineItemsTarget::MODE_CHEAPEST
            ),
            '0.9' . trim((string)mt_rand(1, TestHelper::RAND_MAX), '0'),
            true,
            true
        );
        $request = CartDiscountCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        TestHelper::getInstance($this->getClient())->setCartDiscount($request->mapResponse($response));

        $discountCode = $this->getDiscountCode();

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(CartAddDiscountCodeAction::ofCode($discountCode->getCode()))
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($discountCode->getId(), $cart->getDiscountCodes()->current()->getDiscountCode()->getId());

        $this->assertSame(
            TestHelper::getInstance($this->getClient())->getCartDiscount()->getId(),
            $cart->getLineItems()->current()
                ->getDiscountedPricePerQuantity()->current()
                ->getDiscountedPrice()->getIncludedDiscounts()->current()
                ->getDiscount()->getId()
        );
        $this->assertSame(
            $cart->getLineItems()->current()->getPrice()->getValue()->getCentAmount() * 2,
            $cart->getLineItems()->current()->getTotalPrice()->getCentAmount()
        );
    }

    public function testMultiBuyCustomLineItemDiscount()
    {
        $draft = $this->getDraft();
        $draft->setCustomLineItems(
            CustomLineItemDraftCollection::of()
                ->add(
                    CustomLineItemDraft::ofNameMoneySlugAndTaxCategory(
                        LocalizedString::ofLangAndText('en', 'Test'),
                        Money::ofCurrencyAndAmount('EUR', 1000),
                        'test',
                        $this->getTaxCategory()->getReference()
                    )->setQuantity(3)
                )
        );

        $cart = $this->createCart($draft);

        $draft = CartDiscountDraft::ofNameValuePredicateTargetOrderActiveAndDiscountCode(
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-discount'),
            RelativeCartDiscountValue::of()->setPermyriad(10000),
            '1=1',
            MultiBuyCustomLineItemsTarget::ofPredicateTriggerDiscountedAndMode(
                '1=1',
                3,
                1,
                MultiBuyCustomLineItemsTarget::MODE_CHEAPEST
            ),
            '0.9' . trim((string)mt_rand(1, TestHelper::RAND_MAX), '0'),
            true,
            true
        );
        $request = CartDiscountCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        TestHelper::getInstance($this->getClient())->setCartDiscount($request->mapResponse($response));

        $discountCode = $this->getDiscountCode();

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(CartAddDiscountCodeAction::ofCode($discountCode->getCode()))
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($discountCode->getId(), $cart->getDiscountCodes()->current()->getDiscountCode()->getId());

        $this->assertSame(
            TestHelper::getInstance($this->getClient())->getCartDiscount()->getId(),
            $cart->getCustomLineItems()->current()
                ->getDiscountedPricePerQuantity()->current()
                ->getDiscountedPrice()->getIncludedDiscounts()->current()
                ->getDiscount()->getId()
        );
        $this->assertSame(
            $cart->getCustomLineItems()->current()->getMoney()->getCentAmount() * 2,
            $cart->getCustomLineItems()->current()->getTotalPrice()->getCentAmount()
        );
    }

    public function testDiscountCodeCustomLineItemPredicate()
    {
        $type = $this->getType('key-' . $this->getTestRun(), 'line-item');
        $draft = $this->getDraft();
        $draft->setLineItems(
            LineItemDraftCollection::of()
                ->add(
                    LineItemDraft::of()->setProductId($this->getProduct()->getId())->setVariantId(1)->setQuantity(1)
                        ->setCustom(
                            CustomFieldObject::of()
                                ->setType($type->getReference())
                                ->setFields(FieldContainer::of()->set('testField', $this->getTestRun()))
                        )
                )
        );

        $cart = $this->createCart($draft);

        $draft = CartDiscountDraft::ofNameValuePredicateTargetOrderActiveAndDiscountCode(
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-discount'),
            CartDiscountValue::of()->setType('absolute')->setMoney(
                MoneyCollection::of()->add(Money::ofCurrencyAndAmount('EUR', 100))
            ),
            '1=1',
            CartDiscountTarget::of()->setType('lineItems')->setPredicate('custom.testField = "' . $this->getTestRun() . '"'),
            '0.9' . trim((string)mt_rand(1, TestHelper::RAND_MAX), '0'),
            true,
            true
        );
        $request = CartDiscountCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        TestHelper::getInstance($this->getClient())->setCartDiscount($request->mapResponse($response));

        $discountCode = $this->getDiscountCode();

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(CartAddDiscountCodeAction::ofCode($discountCode->getCode()))
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($discountCode->getId(), $cart->getDiscountCodes()->current()->getDiscountCode()->getId());

        $this->assertSame(
            TestHelper::getInstance($this->getClient())->getCartDiscount()->getId(),
            $cart->getLineItems()->current()
                ->getDiscountedPricePerQuantity()->current()
                ->getDiscountedPrice()->getIncludedDiscounts()->current()
                ->getDiscount()->getId()
        );
    }

    public function localeProvider()
    {
        return [
            ['en', 'en'],
            ['de', 'de'],
            ['de-de', 'de-DE'],
            ['de-DE', 'de-DE'],
            ['de_de', 'de-DE'],
            ['de_DE', 'de-DE'],
        ];
    }

    /**
     * @dataProvider localeProvider
     */
    public function testLocale($locale, $expectedLocale)
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(CartSetLocaleAction::ofLocale($locale))
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);

        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($expectedLocale, $cart->getLocale());
    }

    public function testCustomerGroup()
    {
        $customerGroup = $this->getCustomerGroup();
        $draft = $this->getDraft();
        $draft->setCustomerGroup($customerGroup->getReference());
        $cart = $this->createCart($draft);

        $this->assertSame($customerGroup->getId(), $cart->getCustomerGroup()->getId());

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(CartSetCustomerGroupAction::of())
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);

        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertNull($cart->getCustomerGroup());
    }

    public function invalidLocaleProvider()
    {
        return [
            ['en-en'],
            ['en_en'],
            ['en_EN'],
            ['en-EN'],
            ['fr'],
        ];
    }

    /**
     * @dataProvider invalidLocaleProvider
     */
    public function testInvalidLocale($locale)
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(CartSetLocaleAction::ofLocale($locale))
        ;
        $response = $request->executeWithClient($this->getClient());

        $this->assertTrue($response->isError());
    }

    public function testTaxRoundingMode()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $this->assertSame(Cart::TAX_ROUNDING_MODE_HALF_EVEN, $cart->getTaxRoundingMode());

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(CartChangeTaxRoundingModeAction::ofTaxRoundingMode(Cart::TAX_ROUNDING_MODE_HALF_DOWN))
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);

        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame(Cart::TAX_ROUNDING_MODE_HALF_DOWN, $cart->getTaxRoundingMode());
    }

    public function testCreateWithTaxRoundingMode()
    {
        $draft = $this->getDraft();
        $draft->setTaxRoundingMode(Cart::TAX_ROUNDING_MODE_HALF_DOWN);
        $cart = $this->createCart($draft);

        $this->assertSame(Cart::TAX_ROUNDING_MODE_HALF_DOWN, $cart->getTaxRoundingMode());
    }

    public function testTaxCalculationModeUnitPrice()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $this->assertSame(Cart::TAX_CALCULATION_MODE_LINE_ITEM_LEVEL, $cart->getTaxCalculationMode());

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(CartChangeTaxCalculationModeAction::ofTaxCalculationMode(Cart::TAX_CALCULATION_MODE_UNIT_PRICE_LEVEL))
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);

        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame(Cart::TAX_CALCULATION_MODE_UNIT_PRICE_LEVEL, $cart->getTaxCalculationMode());
    }

    public function testCreateWithTaxCalculationMode()
    {
        $draft = $this->getDraft();
        $draft->setTaxCalculationMode(Cart::TAX_CALCULATION_MODE_UNIT_PRICE_LEVEL);
        $cart = $this->createCart($draft);

        $this->assertSame(Cart::TAX_CALCULATION_MODE_UNIT_PRICE_LEVEL, $cart->getTaxCalculationMode());
    }


    public function testAutomaticDelete()
    {
        $draft = $this->getDraft();
        $draft->setDeleteDaysAfterLastModification(1);
        $cart = $this->createCart($draft);

        $this->assertSame(1, $cart->getDeleteDaysAfterLastModification());

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(CartSetDeleteDaysAfterLastModificationAction::ofDays(2))
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);

        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame(2, $cart->getDeleteDaysAfterLastModification());
    }

    public function testPriceTiersOnAddLineItem()
    {
        $productDraft = $this->getProductDraft();
        $productDraft->getMasterVariant()->getPrices()->current()->setTiers(PriceTierCollection::of()
            ->add(
                PriceTier::of()->setValue(Money::ofCurrencyAndAmount('EUR', 10))->setMinimumQuantity(2)
            )
            ->add(
                PriceTier::of()->setValue(Money::ofCurrencyAndAmount('EUR', 1))->setMinimumQuantity(3)
            ));
        $product = $this->getProduct($productDraft);
        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();

        $draft = $this->getDraft();
        $draft->setLineItems(
            LineItemDraftCollection::of()
                ->add(LineItemDraft::of()->setProductId($product->getId())->setVariantId($variant->getId())->setQuantity(1))
        );
        $cart = $this->createCart($draft);

        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($product->getId(), $cart->getLineItems()->current()->getProductId());
        $this->assertSame(
            $product->getProductType()->getId(),
            $cart->getLineItems()->current()->getProductType()->getId()
        );
        $this->assertSame(
            100,
            $cart->getLineItems()->current()->getPrice()->getValue()->getCentAmount()
        );

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartAddLineItemAction::ofProductIdVariantIdAndQuantity($product->getId(), $variant->getId(), 1)
            );

        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($product->getId(), $cart->getLineItems()->current()->getProductId());
        $this->assertSame(
            $product->getProductType()->getId(),
            $cart->getLineItems()->current()->getProductType()->getId()
        );
        $this->assertSame(
            10,
            $cart->getLineItems()->current()->getPrice()->getValue()->getCentAmount()
        );

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartChangeLineItemQuantityAction::ofLineItemIdAndQuantity($cart->getLineItems()->current()->getId(), 3)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());
        $this->assertSame(3, $cart->getLineItems()->current()->getQuantity());
        $this->assertSame(
            1,
            $cart->getLineItems()->current()->getPrice()->getValue()->getCentAmount()
        );

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartRemoveLineItemAction::ofLineItemId($cart->getLineItems()->current()->getId())->setQuantity(1)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame(2, $cart->getLineItems()->current()->getQuantity());
        $this->assertSame(
            10,
            $cart->getLineItems()->current()->getPrice()->getValue()->getCentAmount()
        );

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartRemoveLineItemAction::ofLineItemId($cart->getLineItems()->current()->getId())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());
        $this->assertCount(0, $cart->getLineItems());
    }

    public function testGiftLineItem()
    {
        $cartDiscount = $this->getGiftLineItemCartDiscount();

        $product = $this->getProduct();
        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();

        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartAddLineItemAction::ofProductIdVariantIdAndQuantity($product->getId(), $variant->getId(), 1)
            );

        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertCount(2, $cart->getLineItems());

        $this->assertSame(100, $cart->getTotalPrice()->getCentAmount());

        $giftLineItemIncluded = false;
        foreach ($cart->getLineItems() as $lineItem) {
            $this->assertSame($product->getReference()->getId(), $lineItem->getProductId());
            $this->assertSame($variant->getId(), $lineItem->getVariant()->getId());
            if ($lineItem->getLineItemMode() == LineItem::LINE_ITEM_MODE_GIFT_LINE_ITEM) {
                $giftLineItemIncluded = true;
                $this->assertSame(0, $lineItem->getTotalPrice()->getCentAmount());
                $this->assertCount(1, $lineItem->getDiscountedPricePerQuantity());
                $this->assertSame(
                    $cartDiscount->getId(),
                    $lineItem->getDiscountedPricePerQuantity()->current()
                            ->getDiscountedPrice()->getIncludedDiscounts()->current()
                            ->getDiscount()->getId()
                );
            }
        }
        $this->assertTrue($giftLineItemIncluded);
    }

    public function testSetLineItemTaxAmount()
    {
        $product = $this->getProduct();
        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();

        $draft = $this->getDraft();
        $draft->setLineItems(LineItemDraftCollection::of()->add(LineItemDraft::ofSku($variant->getSku())));
        $draft->setTaxMode(Cart::TAX_MODE_EXTERNAL_AMOUNT);
        $cart = $this->createCart($draft);

        $taxAmount = mt_rand(1, 100000);
        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartSetLineItemTaxAmountAction::of()
                    ->setLineItemId($cart->getLineItems()->current()->getId())
                    ->setExternalTaxAmount(
                        ExternalTaxAmountDraft::of()
                            ->setTotalGross(Money::ofCurrencyAndAmount('EUR', $taxAmount))
                            ->setTaxRate(ExternalTaxRateDraft::ofNameCountryAndAmount('test', 'DE', 1.0))
                    )
            );
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($taxAmount, $cart->getLineItems()->current()->getTaxedPrice()->getTotalGross()->getCentAmount());
    }

    public function testSetCustomLineItemTaxAmount()
    {
        $draft = $this->getDraft();
        $draft->setCustomLineItems(
            CustomLineItemDraftCollection::of()
                ->add(
                    CustomLineItemDraft::ofNameMoneyAndSlug(
                        LocalizedString::ofLangAndText('en', 'test'),
                        Money::ofCurrencyAndAmount('EUR', 100),
                        'test-124'
                    )->setQuantity(1)
                )
        );
        $draft->setTaxMode(Cart::TAX_MODE_EXTERNAL_AMOUNT);
        $cart = $this->createCart($draft);

        $taxAmount = mt_rand(1, 100000);
        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartSetCustomLineItemTaxAmountAction::of()
                    ->setCustomLineItemId($cart->getCustomLineItems()->current()->getId())
                    ->setExternalTaxAmount(
                        ExternalTaxAmountDraft::of()
                            ->setTotalGross(Money::ofCurrencyAndAmount('EUR', $taxAmount))
                            ->setTaxRate(ExternalTaxRateDraft::ofNameCountryAndAmount('test', 'DE', 1.0))
                    )
            );
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($taxAmount, $cart->getCustomLineItems()->current()->getTaxedPrice()->getTotalGross()->getCentAmount());
    }

    public function testSetShippingMethodTaxAmount()
    {
        $shippingMethod = $this->getShippingMethod();
        $draft = $this->getDraft();
        $draft->setShippingAddress(Address::of()->setCountry('DE')->setState($this->getRegion()));
        $draft->setShippingMethod($shippingMethod->getReference());
        $draft->setTaxMode(Cart::TAX_MODE_EXTERNAL_AMOUNT);
        $cart = $this->createCart($draft);

        $taxAmount = mt_rand(1, 100000);
        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartSetShippingMethodTaxAmountAction::of()
                    ->setExternalTaxAmount(
                        ExternalTaxAmountDraft::of()
                            ->setTotalGross(Money::ofCurrencyAndAmount('EUR', $taxAmount))
                            ->setTaxRate(ExternalTaxRateDraft::ofNameCountryAndAmount('test', 'DE', 1.0))
                    )
            );
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($taxAmount, $cart->getShippingInfo()->getTaxedPrice()->getTotalGross()->getCentAmount());
    }

    public function testSetTotalTaxAmount()
    {
        $product = $this->getProduct();
        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();

        $draft = $this->getDraft();
        $draft->setLineItems(LineItemDraftCollection::of()->add(LineItemDraft::ofSku($variant->getSku())));
        $draft->setTaxMode(Cart::TAX_MODE_EXTERNAL_AMOUNT);
        $cart = $this->createCart($draft);

        $taxAmount = mt_rand(1, 100000);
        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartSetCartTotalTaxAction::of()
                    ->setExternalTotalGross(
                        Money::ofCurrencyAndAmount('EUR', $taxAmount)
                    )
            );
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($taxAmount, $cart->getTaxedPrice()->getTotalGross()->getCentAmount());
    }

    public function testSetShippingRateInput()
    {
        $request = ProjectGetRequest::of();
        $response = $request->executeWithClient($this->getClient());
        $project = $request->mapResponse($response);

        $this->assertInstanceOf(Project::class, $project);

        $request = ProjectUpdateRequest::ofVersion($project->getVersion());
        $request->addAction(
            ProjectSetShippingRateInputTypeAction::of()
                ->setShippingRateInputType(CartScoreType::of())
        );
        $request->executeWithClient($this->getClient());

        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartSetShippingRateInputAction::of()
                    ->setShippingRateInput(ScoreShippingRateInput::ofScore(1))
            );
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertInstanceOf(ScoreShippingRateInput::class, $cart->getShippingRateInput());
        $this->assertSame(1, $cart->getShippingRateInput()->getScore());
    }

    public function testCartAddLineItemWithShippingDetailsAndApplyDelta()
    {
        $draft = $this->getDraft();
        $draft->setItemShippingAddresses(AddressCollection::of()->add(
            Address::of()->setCountry('DE')->setKey('key1')
        ));
        $cart = $this->createCart($draft);

        $product = $this->getProduct();
        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartAddLineItemAction::ofProductIdVariantIdAndQuantity($product->getId(), $variant->getId(), 1)
                    ->setShippingDetails(ItemShippingDetailsDraft::of()
                        ->setTargets(ItemShippingTargetCollection::of()
                            ->add(ItemShippingTarget::of()
                                ->setQuantity(10)->setAddressKey('key1'))))
            );

        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);

        $this->deleteRequest->setVersion($cart->getVersion());

        $itemShippingAddresses = $cart->getItemShippingAddresses();
        $addressKey = $cart->getLineItems()->current()->getShippingDetails()->getTargets()->current()->getAddressKey();

        $this->assertInstanceOf(AddressCollection::class, $itemShippingAddresses);
        $this->assertSame('DE', $itemShippingAddresses->current()->getCountry());
        $this->assertSame('key1', $itemShippingAddresses->current()->getKey());
        $this->assertSame('key1', $addressKey);

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartApplyDeltaToLineItemShippingDetailsTargetsAction::of()
                    ->setLineItemId($cart->getLineItems()->current()->getId())
                    ->setTargetsDelta(ItemShippingTargetCollection::of()->add(
                        ItemShippingTarget::of()->setQuantity(15)->setAddressKey('key1')
                    ))
            );

        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame(
            'key1',
            $cart->getLineItems()->current()->getShippingDetails()->getTargets()->current()->getAddressKey()
        );
        $this->assertSame(
            25,
            $cart->getLineItems()->current()->getShippingDetails()->getTargets()->current()->getQuantity()
        );

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartSetLineItemShippingDetailsAction::ofLineItemIdAndShippingDetails(
                    $cart->getLineItems()->current()->getId(),
                    ItemShippingDetailsDraft::of()->setTargets(ItemShippingTargetCollection::of()->add(
                        ItemShippingTarget::of()->setQuantity(20)->setAddressKey('key1')
                    ))
                )
            );

        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame(
            'key1',
            $cart->getLineItems()->current()->getShippingDetails()->getTargets()->current()->getAddressKey()
        );
        $this->assertSame(
            20,
            $cart->getLineItems()->current()->getShippingDetails()->getTargets()->current()->getQuantity()
        );
    }

    public function testCartAddItemShippingAddressAction()
    {
        $draft = $this->getDraft();
        $draft->setItemShippingAddresses(
            AddressCollection::of()->add(Address::of()->setCountry('DE')->setKey('key1'))
        );
        $cart = $this->createCart($draft);

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(CartAddItemShippingAddressAction::of()
                ->setAddress(Address::of()->setKey('key2')->setCountry('US')));

        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);

        $itemShippingAddresses = $cart->getItemShippingAddresses();

        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertInstanceOf(AddressCollection::class, $itemShippingAddresses);
        $this->assertSame(2, $itemShippingAddresses->count());
        $this->assertSame('US', $itemShippingAddresses->getAt(1)->getCountry());
        $this->assertSame('key2', $itemShippingAddresses->getAt(1)->getKey());
    }

    public function testCartRemoveItemShippingAddressAction()
    {
        $draft = $this->getDraft();
        $draft->setItemShippingAddresses(
            AddressCollection::of()
                ->add(Address::of()->setCountry('DE')->setKey('key1'))
                ->add(Address::of()->setCountry('US')->setKey('key2'))
        );
        $cart = $this->createCart($draft);

        $itemShippingAddresses = $cart->getItemShippingAddresses();
        $this->assertInstanceOf(AddressCollection::class, $itemShippingAddresses);
        $this->assertSame(2, $itemShippingAddresses->count());

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(CartRemoveItemShippingAddressAction::of()->setAddressKey('key1'));

        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);

        $this->deleteRequest->setVersion($cart->getVersion());

        $itemShippingAddresses = $cart->getItemShippingAddresses();
        $this->assertSame(1, $itemShippingAddresses->count());
        $this->assertSame('US', $itemShippingAddresses->getAt(0)->getCountry());
        $this->assertSame('key2', $itemShippingAddresses->getAt(0)->getKey());
    }

    public function testCartUpdateItemShippingAddressAction()
    {
        $draft = $this->getDraft();
        $draft->setItemShippingAddresses(
            AddressCollection::of()
                ->add(Address::of()->setCountry('DE')->setKey('key1'))
        );
        $cart = $this->createCart($draft);

        $itemShippingAddresses = $cart->getItemShippingAddresses();
        $this->assertInstanceOf(AddressCollection::class, $itemShippingAddresses);
        $this->assertSame(1, $itemShippingAddresses->count());
        $this->assertSame('DE', $itemShippingAddresses->getAt(0)->getCountry());

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(CartUpdateItemShippingAddressAction::of()->setAddress(
                Address::of()->setCountry('US')->setKey('key1')
            ));

        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);

        $this->deleteRequest->setVersion($cart->getVersion());

        $itemShippingAddresses = $cart->getItemShippingAddresses();
        $this->assertSame(1, $itemShippingAddresses->count());
        $this->assertSame('US', $itemShippingAddresses->getAt(0)->getCountry());
        $this->assertSame('key1', $itemShippingAddresses->getAt(0)->getKey());
    }

    public function testCustomLineItemSetShippingDetailsAndApplyDelta()
    {
        $draft = $this->getDraft();
        $name = LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun());

        $customLineItem = CustomLineItemDraft::ofNameMoneySlugAndTaxCategory(
            $name,
            Money::ofCurrencyAndAmount('EUR', 100),
            $name->en,
            $this->getTaxCategory()->getReference()
        )->setQuantity(1);
        $draft->setCustomLineItems(CustomLineItemDraftCollection::of()->add($customLineItem));

        $cart = $this->createCart($draft);

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(CartAddItemShippingAddressAction::of()
                ->setAddress(Address::of()->setKey('key1')->setCountry('US')))
            ->addAction(
                CartSetCustomLineItemShippingDetailsAction::ofCustomLineItemIdAndShippingDetails(
                    $cart->getCustomLineItems()->current()->getId(),
                    ItemShippingDetailsDraft::of()->setTargets(ItemShippingTargetCollection::of()->add(
                        ItemShippingTarget::of()->setQuantity(10)->setAddressKey('key1')
                    ))
                )
            );

        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($name->en, $cart->getCustomLineItems()->current()->getName()->en);
        $this->assertSame(
            'key1',
            $cart->getCustomLineItems()->current()->getShippingDetails()->getTargets()->current()->getAddressKey()
        );
        $this->assertSame(
            10,
            $cart->getCustomLineItems()->current()->getShippingDetails()->getTargets()->current()->getQuantity()
        );

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartApplyDeltaToCustomLineItemShippingDetailsTargetsAction::of()
                    ->setCustomLineItemId($cart->getCustomLineItems()->current()->getId())
                    ->setTargetsDelta(ItemShippingTargetCollection::of()->add(
                        ItemShippingTarget::of()->setQuantity(20)->setAddressKey('key1')
                    ))
            );

        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame(
            'key1',
            $cart->getCustomLineItems()->current()->getShippingDetails()->getTargets()->current()->getAddressKey()
        );
        $this->assertSame(
            30,
            $cart->getCustomLineItems()->current()->getShippingDetails()->getTargets()->current()->getQuantity()
        );
    }

    public function testUpdateAndDeleteForCartInStore()
    {
        $store = $this->getStore();
        $cartDraft = $this->getDraft()->setStore(StoreReference::ofKey($store->getKey()));
        $cart = $this->createCart($cartDraft);

        $email = 'test-' . $this->getTestRun() . '@example.com';

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(CartSetCustomerEmailAction::of()->setEmail($email))
            ->inStore($store->getKey());

        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Cart::class, $result);
        $this->assertSame($cart->getId(), $result->getId());
        $this->assertSame($email, $result->getCustomerEmail());
        $this->assertSame('in-store/key='.$store->getKey().'/carts/'.$result->getId(), (string)$request->httpRequest()->getUri());
        $this->assertSame($store->getKey(), $result->getStore()->getKey());

        $request = InStoreRequestDecorator::ofStoreKeyAndRequest($store->getKey(), CartDeleteRequest::ofIdAndVersion($result->getId(), $result->getVersion()));
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(Cart::class, $result);
        $this->assertSame($cart->getId(), $result->getId());
    }

    /**
     * @return CartDraft
     */
    protected function getDraft()
    {
        $draft = CartDraft::ofCurrencyAndCountry('EUR', 'DE');

        return $draft;
    }

    protected function createCart(CartDraft $draft)
    {
        $request = CartCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);

        $this->deleteRequest = CartDeleteRequest::ofIdAndVersion($cart->getId(), $cart->getVersion());
        $this->cleanupRequests[] = $this->deleteRequest;

        return $cart;
    }
}
