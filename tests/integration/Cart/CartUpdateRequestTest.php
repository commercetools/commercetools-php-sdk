<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Cart;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Model\Cart\CartDraft;
use Commercetools\Core\Model\CartDiscount\CartDiscount;
use Commercetools\Core\Model\CartDiscount\CartDiscountDraft;
use Commercetools\Core\Model\CartDiscount\CartDiscountReferenceCollection;
use Commercetools\Core\Model\CartDiscount\CartDiscountTarget;
use Commercetools\Core\Model\CartDiscount\CartDiscountValue;
use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\MoneyCollection;
use Commercetools\Core\Model\Common\Price;
use Commercetools\Core\Model\Common\PriceCollection;
use Commercetools\Core\Model\Common\PriceDraft;
use Commercetools\Core\Model\Common\PriceDraftCollection;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Model\Customer\CustomerDraft;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use Commercetools\Core\Model\CustomObject\CustomObjectDraft;
use Commercetools\Core\Model\DiscountCode\DiscountCode;
use Commercetools\Core\Model\DiscountCode\DiscountCodeDraft;
use Commercetools\Core\Model\Payment\Payment;
use Commercetools\Core\Model\Payment\PaymentDraft;
use Commercetools\Core\Model\Payment\PaymentMethodInfo;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Model\Product\ProductDraft;
use Commercetools\Core\Model\Product\ProductVariantDraft;
use Commercetools\Core\Model\Product\ProductVariantDraftCollection;
use Commercetools\Core\Model\ProductType\ProductType;
use Commercetools\Core\Model\ProductType\ProductTypeDraft;
use Commercetools\Core\Model\ShippingMethod\ShippingMethod;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodDraft;
use Commercetools\Core\Model\ShippingMethod\ShippingRate;
use Commercetools\Core\Model\ShippingMethod\ShippingRateCollection;
use Commercetools\Core\Model\ShippingMethod\ZoneRate;
use Commercetools\Core\Model\ShippingMethod\ZoneRateCollection;
use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Model\TaxCategory\TaxCategoryDraft;
use Commercetools\Core\Model\TaxCategory\TaxRate;
use Commercetools\Core\Model\TaxCategory\TaxRateCollection;
use Commercetools\Core\Model\Type\FieldDefinition;
use Commercetools\Core\Model\Type\FieldDefinitionCollection;
use Commercetools\Core\Model\Type\StringType;
use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Model\Type\TypeDraft;
use Commercetools\Core\Model\Zone\Location;
use Commercetools\Core\Model\Zone\LocationCollection;
use Commercetools\Core\Model\Zone\Zone;
use Commercetools\Core\Model\Zone\ZoneDraft;
use Commercetools\Core\Request\CartDiscounts\CartDiscountCreateRequest;
use Commercetools\Core\Request\CartDiscounts\CartDiscountDeleteRequest;
use Commercetools\Core\Request\Carts\CartCreateRequest;
use Commercetools\Core\Request\Carts\CartDeleteRequest;
use Commercetools\Core\Request\Carts\CartUpdateRequest;
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
use Commercetools\Core\Request\Customers\CustomerCreateRequest;
use Commercetools\Core\Request\Customers\CustomerDeleteRequest;
use Commercetools\Core\Request\CustomField\Command\SetCustomFieldAction;
use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;
use Commercetools\Core\Request\DiscountCodes\DiscountCodeCreateRequest;
use Commercetools\Core\Request\DiscountCodes\DiscountCodeDeleteRequest;
use Commercetools\Core\Request\Payments\PaymentCreateRequest;
use Commercetools\Core\Request\Payments\PaymentDeleteRequest;
use Commercetools\Core\Request\Products\Command\ProductChangePriceAction;
use Commercetools\Core\Request\Products\Command\ProductPublishAction;
use Commercetools\Core\Request\Products\Command\ProductUnpublishAction;
use Commercetools\Core\Request\Products\ProductCreateRequest;
use Commercetools\Core\Request\Products\ProductDeleteRequest;
use Commercetools\Core\Request\Products\ProductUpdateRequest;
use Commercetools\Core\Request\ProductTypes\ProductTypeCreateRequest;
use Commercetools\Core\Request\ProductTypes\ProductTypeDeleteRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodCreateRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodDeleteRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryCreateRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryDeleteRequest;
use Commercetools\Core\Request\Types\TypeCreateRequest;
use Commercetools\Core\Request\Types\TypeDeleteRequest;
use Commercetools\Core\Request\Zones\ZoneCreateRequest;
use Commercetools\Core\Request\Zones\ZoneDeleteRequest;

class CartUpdateRequestTest extends ApiTestCase
{
    /**
     * @var CartDeleteRequest
     */
    protected $cartDeleteRequest;

    /**
     * @var Product
     */
    private $product;

     /**
     * @var ProductType
     */
    private $productType;

    /**
     * @var TaxCategory
     */
    private $taxCategory;

    /**
     * @var string
     */
    private $state;

    /**
     * @var Zone
     */
    private $zone;

    /**
     * @var ShippingMethod
     */
    private $shippingMethod;

    /**
     * @var Customer
     */
    private $customer;

    /**
     * @var Type
     */
    private $type;

    /**
     * @var Payment
     */
    private $payment;

    /**
     * @var CartDiscount
     */
    private $cartDiscount;

    /**
     * @var DiscountCode
     */
    private $discountCode;

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
        $this->cartDeleteRequest->setVersion($cart->getVersion());

        $this->assertSame($product->getId(), $cart->getLineItems()->current()->getProductId());

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartChangeLineItemQuantityAction::ofLineItemIdAndQuantity($cart->getLineItems()->current()->getId(), 2)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->cartDeleteRequest->setVersion($cart->getVersion());

        $this->assertSame(2, $cart->getLineItems()->current()->getQuantity());

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartRemoveLineItemAction::ofLineItemId($cart->getLineItems()->current()->getId())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->cartDeleteRequest->setVersion($cart->getVersion());

        $this->assertCount(0, $cart->getLineItems());
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
        $this->cartDeleteRequest->setVersion($cart->getVersion());

        $this->assertSame($name->en, $cart->getCustomLineItems()->current()->getName()->en);

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartRemoveCustomLineItemAction::ofCustomLineItemId($cart->getCustomLineItems()->current()->getId())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->cartDeleteRequest->setVersion($cart->getVersion());

        $this->assertCount(0, $cart->getLineItems());
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
        $this->cartDeleteRequest->setVersion($cart->getVersion());

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
        $this->cartDeleteRequest->setVersion($cart->getVersion());

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
        $this->cartDeleteRequest->setVersion($cart->getVersion());

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
        $this->cartDeleteRequest->setVersion($cart->getVersion());

        $this->assertSame($country, $cart->getCountry());
    }

    public function testSetShippingMethod()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $shippingMethod = $this->getShippingMethod();
        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartSetShippingAddressAction::of()->setAddress(
                    Address::of()->setCountry('DE')->setState($this->getState())
                )
            )
            ->addAction(
                CartSetShippingMethodAction::of()->setShippingMethod($shippingMethod->getReference())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->cartDeleteRequest->setVersion($cart->getVersion());

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
                    Address::of()->setCountry('DE')->setState($this->getState())
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
        $this->cartDeleteRequest->setVersion($cart->getVersion());

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
        $this->cartDeleteRequest->setVersion($cart->getVersion());

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
        $this->cartDeleteRequest->setVersion($cart->getVersion());

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
        $this->product = $request->mapResponse($response);

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(CartRecalculateAction::of())
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->cartDeleteRequest->setVersion($cart->getVersion());

        $this->assertSame(200, $cart->getTotalPrice()->getCentAmount());
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
        $this->cartDeleteRequest->setVersion($cart->getVersion());

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
        $this->cartDeleteRequest->setVersion($cart->getVersion());

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
        $this->cartDeleteRequest->setVersion($cart->getVersion());

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartSetLineItemCustomTypeAction::ofTypeKey($type->getKey())
                    ->setLineItemId($cart->getLineItems()->current()->getId())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->cartDeleteRequest->setVersion($cart->getVersion());

        $this->assertSame($type->getId(), $cart->getLineItems()->current()->getCustom()->getType()->getId());
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
        $this->cartDeleteRequest->setVersion($cart->getVersion());

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartSetCustomLineItemCustomTypeAction::ofTypeKey($type->getKey())
                    ->setCustomLineItemId($cart->getCustomLineItems()->current()->getId())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->cartDeleteRequest->setVersion($cart->getVersion());

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
        $this->cartDeleteRequest->setVersion($cart->getVersion());

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartSetLineItemCustomFieldAction::ofName('testField')
                    ->setLineItemId($cart->getLineItems()->current()->getId())
                    ->setValue($this->getTestRun())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->cartDeleteRequest->setVersion($cart->getVersion());

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
        $this->cartDeleteRequest->setVersion($cart->getVersion());

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartSetCustomLineItemCustomFieldAction::ofName('testField')
                    ->setCustomLineItemId($cart->getCustomLineItems()->current()->getId())
                    ->setValue($this->getTestRun())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->cartDeleteRequest->setVersion($cart->getVersion());

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
        $this->cartDeleteRequest->setVersion($cart->getVersion());

        $this->assertSame($payment->getId(), $cart->getPaymentInfo()->getPayments()->current()->getId());
        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(CartRemovePaymentAction::of()->setPayment($payment->getReference()))
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->cartDeleteRequest->setVersion($cart->getVersion());
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
        $this->cartDeleteRequest->setVersion($cart->getVersion());

        $this->assertSame($discountCode->getId(), $cart->getDiscountCodes()->current()->getDiscountCode()->getId());

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(CartRemoveDiscountCodeAction::ofDiscountCode($discountCode->getReference()))
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->cartDeleteRequest->setVersion($cart->getVersion());
        $this->assertEmpty($cart->getDiscountCodes());
    }

    private function getState()
    {
        if (is_null($this->state)) {
            $this->state = (string)mt_rand(1, 1000);
        }

        return $this->state;
    }

    private function getTaxCategory()
    {
        if (is_null($this->taxCategory)) {
            $taxCategoryDraft = TaxCategoryDraft::ofNameAndRates(
                'test-' . $this->getTestRun() . '-name',
                TaxRateCollection::of()->add(
                    TaxRate::of()->setName('test-' . $this->getTestRun() . '-name')
                        ->setAmount((float)('0.2' . mt_rand(1, 100)))
                        ->setIncludedInPrice(true)
                        ->setCountry('DE')
                        ->setState($this->getState())
                )
            );
            $request = TaxCategoryCreateRequest::ofDraft($taxCategoryDraft);
            $response = $request->executeWithClient($this->getClient());
            $this->taxCategory = $request->mapResponse($response);
        }

        return $this->taxCategory;
    }

    private function deleteTaxCategory()
    {
        if (!is_null($this->taxCategory)) {
            $request = TaxCategoryDeleteRequest::ofIdAndVersion(
                $this->taxCategory->getId(),
                $this->taxCategory->getVersion()
            );
            $response = $request->executeWithClient($this->getClient());
            $this->taxCategory = $request->mapResponse($response);
        }
        $this->taxCategory = null;
    }

    private function getZone()
    {
        if (is_null($this->zone)) {
            $zoneDraft = ZoneDraft::ofNameAndLocations(
                'test-' . $this->getTestRun() . '-name',
                LocationCollection::of()->add(
                    Location::of()->setCountry('DE')->setState($this->getState())
                )
            );
            $request = ZoneCreateRequest::ofDraft($zoneDraft);
            $response = $request->executeWithClient($this->getClient());
            $this->zone = $request->mapResponse($response);
        }

        return $this->zone;
    }

    private function deleteZone()
    {
        if (!is_null($this->zone)) {
            $request = ZoneDeleteRequest::ofIdAndVersion(
                $this->zone->getId(),
                $this->zone->getVersion()
            );
            $response = $request->executeWithClient($this->getClient());
            $this->zone = $request->mapResponse($response);
        }
        $this->zone = null;
    }

    /**
     * @param $name
     * @return ShippingMethodDraft
     */
    protected function getShippingMethodDraft($name)
    {
        $draft = ShippingMethodDraft::ofNameTaxCategoryZoneRateAndDefault(
            'test-' . $this->getTestRun() . '-' . $name,
            $this->getTaxCategory()->getReference(),
            ZoneRateCollection::of()->add(
                ZoneRate::of()->setZone($this->getZone()->getReference())
                    ->setShippingRates(
                        ShippingRateCollection::of()->add(
                            ShippingRate::of()->setPrice(Money::ofCurrencyAndAmount('EUR', 100))
                        )
                    )
            ),
            false
        );

        return $draft;
    }

    protected function getShippingMethod()
    {
        if (is_null($this->shippingMethod)) {
            $draft = $this->getShippingMethodDraft('cart');
            $request = ShippingMethodCreateRequest::ofDraft($draft);
            $response = $request->executeWithClient($this->getClient());
            $this->shippingMethod = $request->mapResponse($response);
        }

        return $this->shippingMethod;
    }

    private function deleteShippingMethod()
    {
        if (!is_null($this->shippingMethod)) {
            $request = ShippingMethodDeleteRequest::ofIdAndVersion(
                $this->shippingMethod->getId(),
                $this->shippingMethod->getVersion()
            );
            $request->executeWithClient($this->getClient());
        }
        $this->shippingMethod = null;
    }

    /**
     * @return CustomerDraft
     */
    protected function getCustomerDraft()
    {
        $draft = CustomerDraft::ofEmailNameAndPassword(
            'test-' . $this->getTestRun() . '-email',
            'test-' . $this->getTestRun() . '-firstName',
            'test-' . $this->getTestRun() . '-lastName',
            'test-' . $this->getTestRun() . '-password'
        );

        return $draft;
    }

    protected function getCustomer()
    {
        if (is_null($this->customer)) {
            $draft = $this->getCustomerDraft();
            $request = CustomerCreateRequest::ofDraft($draft);
            $response = $request->executeWithClient($this->getClient());
            $result = $request->mapResponse($response);
            $this->customer = $result->getCustomer();
        }

        return $this->customer;
    }

    protected function deleteCustomer()
    {
        if (!is_null($this->customer)) {
            $request = CustomerDeleteRequest::ofIdAndVersion(
                $this->customer->getId(),
                $this->customer->getVersion()
            );
            $response = $request->executeWithClient($this->getClient());
            $this->customer = $request->mapResponse($response);
        }

        $this->customer = null;
    }

    protected function cleanup()
    {
        parent::cleanup();
        $this->deletePayment();
        $this->deleteProduct();
        $this->deleteCustomer();
        $this->deleteProductType();
        $this->deleteShippingMethod();
        $this->deleteTaxCategory();
        $this->deleteZone();
        $this->deleteType();
        $this->deleteDiscountCode();
        $this->deleteCartDiscount();
    }


    protected function getProductType()
    {
        if (is_null($this->productType)) {
            $productTypeDraft = ProductTypeDraft::ofNameAndDescription(
                'test-' . $this->getTestRun() . '-productType',
                'test-' . $this->getTestRun() . '-productType'
            );
            $request = ProductTypeCreateRequest::ofDraft($productTypeDraft);
            $response = $request->executeWithClient($this->getClient());
            $this->productType = $request->mapResponse($response);
        }

        return $this->productType;
    }

    protected function deleteProductType()
    {
        if (!is_null($this->productType)) {
            $request = ProductTypeDeleteRequest::ofIdAndVersion(
                $this->productType->getId(),
                $this->productType->getVersion()
            );
            $response = $request->executeWithClient($this->getClient());
            $this->productType = $request->mapResponse($response);
        }
        $this->productType = null;
    }

    /**
     * @return ProductDraft
     */
    protected function getProductDraft()
    {
        $draft = ProductDraft::ofTypeNameAndSlug(
            $this->getProductType()->getReference(),
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-product'),
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-product')
        )
            ->setMasterVariant(
                ProductVariantDraft::of()->setSku('test-' . $this->getTestRun() . '-sku')
                    ->setPrices(
                        PriceDraftCollection::of()->add(
                            PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 100))
                                ->setCountry('DE')
                        )
                    )
            )
            ->setTaxCategory($this->getTaxCategory()->getReference())
        ;

        return $draft;
    }

    protected function getProduct()
    {
        if (is_null($this->product)) {
            $request = ProductCreateRequest::ofDraft($this->getProductDraft());
            $response = $request->executeWithClient($this->getClient());
            $product = $request->mapResponse($response);
            $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
                ->addAction(ProductPublishAction::of());
            $response = $request->executeWithClient($this->getClient());
            $product = $request->mapResponse($response);

            $this->product = $product;
        }

        return $this->product;

    }

    protected function deleteProduct()
    {
        if (!is_null($this->product)) {
            $request = ProductUpdateRequest::ofIdAndVersion($this->product->getId(), $this->product->getVersion())
                ->addAction(ProductUnpublishAction::of());
            $response = $request->executeWithClient($this->getClient());
            $this->product = $request->mapResponse($response);

            $request = ProductDeleteRequest::ofIdAndVersion(
                $this->product->getId(),
                $this->product->getVersion()
            );

            $response = $request->executeWithClient($this->getClient());
            $request->mapResponse($response);
        }

        $this->product = null;
    }

    private function getType($key, $type)
    {
        if (is_null($this->type)) {
            $name = $this->getTestRun() . '-name';
            $typeDraft = TypeDraft::ofKeyNameDescriptionAndResourceTypes(
                $key,
                LocalizedString::ofLangAndText('en', $name),
                LocalizedString::ofLangAndText('en', $name),
                [$type]
            );
            $typeDraft->setFieldDefinitions(
                FieldDefinitionCollection::of()
                    ->add(
                        FieldDefinition::of()
                            ->setName('testField')
                            ->setLabel(LocalizedString::ofLangAndText('en', 'testField'))
                            ->setRequired(false)
                            ->setType(StringType::of())
                    )
            );
            $request = TypeCreateRequest::ofDraft($typeDraft);
            $response = $request->executeWithClient($this->getClient());
            $this->type = $request->mapResponse($response);
        }

        return $this->type;
    }

    private function deleteType()
    {
        if (!is_null($this->type)) {
            $request = TypeDeleteRequest::ofIdAndVersion(
                $this->type->getId(),
                $this->type->getVersion()
            );
            $response = $request->executeWithClient($this->getClient());
            $this->type = $request->mapResponse($response);
        }
        $this->type = null;
    }

    /**
     * @return PaymentDraft
     */
    protected function getPaymentDraft()
    {
        $draft = PaymentDraft::of()
            ->setExternalId('test-' . $this->getTestRun() . '-payment')
            ->setAmountPlanned(Money::ofCurrencyAndAmount('EUR', 100))
            ->setPaymentMethodInfo(
                PaymentMethodInfo::of()
                    ->setPaymentInterface('Test')
                    ->setMethod('CreditCard')
            )
        ;
        return $draft;
    }

    protected function getPayment()
    {
        if (is_null($this->payment)) {
            $draft = $this->getPaymentDraft();
            $request = PaymentCreateRequest::ofDraft($draft);
            $response = $request->executeWithClient($this->getClient());
            $this->payment = $request->mapResponse($response);
        }

        return $this->payment;
    }

    protected function deletePayment()
    {
        if (!is_null($this->payment)) {
            $request = PaymentDeleteRequest::ofIdAndVersion(
                $this->payment->getId(),
                $this->payment->getVersion()
            );
            $request->executeWithClient($this->getClient());
        }
        $this->payment = null;
    }

    protected function getCartDiscount()
    {
        if (is_null($this->cartDiscount)) {
            $draft = CartDiscountDraft::ofNameValuePredicateTargetOrderActiveAndDiscountCode(
                LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-discount'),
                CartDiscountValue::of()->setType('absolute')->setMoney(
                    MoneyCollection::of()->add(Money::ofCurrencyAndAmount('EUR', 100))
                ),
                '1=1',
                CartDiscountTarget::of()->setType('lineItems')->setPredicate('1=1'),
                '0.9' . trim((string)mt_rand(1, 1000), '0'),
                true,
                true
            );
            $request = CartDiscountCreateRequest::ofDraft($draft);
            $response = $request->executeWithClient($this->getClient());
            $this->cartDiscount = $request->mapResponse($response);
        }

        return $this->cartDiscount;
    }

    protected function deleteCartDiscount()
    {
        if (!is_null($this->cartDiscount)) {
            $request = CartDiscountDeleteRequest::ofIdAndVersion(
                $this->cartDiscount->getId(),
                $this->cartDiscount->getVersion()
            );
            $request->executeWithClient($this->getClient());
        }
        $this->cartDiscount = null;
    }

    /**
     * @return DiscountCodeDraft
     */
    protected function getDiscountCodeDraft()
    {
        $draft = DiscountCodeDraft::ofCodeDiscountsAndActive(
            'test-' . $this->getTestRun() . '-code',
            CartDiscountReferenceCollection::of()->add($this->getCartDiscount()->getReference()),
            true
        );

        return $draft;
    }

    protected function getDiscountCode()
    {
        if (is_null($this->discountCode)) {
            $draft = $this->getDiscountCodeDraft();
            $request = DiscountCodeCreateRequest::ofDraft($draft);
            $response = $request->executeWithClient($this->getClient());
            $this->discountCode = $request->mapResponse($response);
        }

        return $this->discountCode;
    }

    protected function deleteDiscountCode()
    {
        if (!is_null($this->discountCode)) {
            $request = DiscountCodeDeleteRequest::ofIdAndVersion(
                $this->discountCode->getId(),
                $this->discountCode->getVersion()
            );
            $request->executeWithClient($this->getClient());
        }

        $this->discountCode = null;
    }

    /**
     * @return CartDraft
     */
    protected function getDraft()
    {
        $draft = CartDraft::ofCurrency('EUR')->setCountry('DE');

        return $draft;
    }

    protected function createCart(CartDraft $draft)
    {
        $request = CartCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);

        $this->cartDeleteRequest = CartDeleteRequest::ofIdAndVersion($cart->getId(), $cart->getVersion());
        $this->cleanupRequests[] = $this->cartDeleteRequest;

        return $cart;
    }
}
