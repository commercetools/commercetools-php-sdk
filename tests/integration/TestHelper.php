<?php
/**
 *
 */

namespace Commercetools\Core\IntegrationTests;

use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Model\Cart\CartDraft;
use Commercetools\Core\Model\CartDiscount\AbsoluteCartDiscountValue;
use Commercetools\Core\Model\CartDiscount\CartDiscount;
use Commercetools\Core\Model\CartDiscount\CartDiscountDraft;
use Commercetools\Core\Model\CartDiscount\CartDiscountReferenceCollection;
use Commercetools\Core\Model\CartDiscount\CartDiscountTarget;
use Commercetools\Core\Model\CartDiscount\GiftLineItemCartDiscountValue;
use Commercetools\Core\Model\Category\Category;
use Commercetools\Core\Model\Category\CategoryDraft;
use Commercetools\Core\Model\Channel\Channel;
use Commercetools\Core\Model\Channel\ChannelDraft;
use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\AddressCollection;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\MoneyCollection;
use Commercetools\Core\Model\Common\PriceDraft;
use Commercetools\Core\Model\Common\PriceDraftCollection;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Model\Customer\CustomerDraft;
use Commercetools\Core\Model\CustomerGroup\CustomerGroup;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupDraft;
use Commercetools\Core\Model\DiscountCode\DiscountCode;
use Commercetools\Core\Model\DiscountCode\DiscountCodeDraft;
use Commercetools\Core\Model\Payment\Payment;
use Commercetools\Core\Model\Payment\PaymentDraft;
use Commercetools\Core\Model\Payment\PaymentMethodInfo;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Model\Product\ProductDraft;
use Commercetools\Core\Model\Product\ProductVariantDraft;
use Commercetools\Core\Model\ProductDiscount\ProductDiscount;
use Commercetools\Core\Model\ProductDiscount\ProductDiscountDraft;
use Commercetools\Core\Model\ProductDiscount\ProductDiscountValue;
use Commercetools\Core\Model\ProductType\AttributeDefinition;
use Commercetools\Core\Model\ProductType\AttributeDefinitionCollection;
use Commercetools\Core\Model\ProductType\ProductType;
use Commercetools\Core\Model\ProductType\ProductTypeDraft;
use Commercetools\Core\Model\ProductType\StringType;
use Commercetools\Core\Model\ShippingMethod\ShippingMethod;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodDraft;
use Commercetools\Core\Model\ShippingMethod\ShippingRate;
use Commercetools\Core\Model\ShippingMethod\ShippingRateCollection;
use Commercetools\Core\Model\ShippingMethod\ZoneRate;
use Commercetools\Core\Model\ShippingMethod\ZoneRateCollection;
use Commercetools\Core\Model\ShoppingList\ShoppingList;
use Commercetools\Core\Model\ShoppingList\ShoppingListDraft;
use Commercetools\Core\Model\State\State;
use Commercetools\Core\Model\State\StateDraft;
use Commercetools\Core\Model\State\StateReferenceCollection;
use Commercetools\Core\Model\Store\Store;
use Commercetools\Core\Model\Store\StoreDraft;
use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Model\TaxCategory\TaxCategoryDraft;
use Commercetools\Core\Model\TaxCategory\TaxRate;
use Commercetools\Core\Model\TaxCategory\TaxRateCollection;
use Commercetools\Core\Model\Type\FieldDefinition;
use Commercetools\Core\Model\Type\FieldDefinitionCollection;
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
use Commercetools\Core\Request\Categories\CategoryCreateRequest;
use Commercetools\Core\Request\Categories\CategoryDeleteRequest;
use Commercetools\Core\Request\Channels\ChannelCreateRequest;
use Commercetools\Core\Request\Channels\ChannelDeleteRequest;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupCreateRequest;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupDeleteRequest;
use Commercetools\Core\Request\Customers\CustomerCreateRequest;
use Commercetools\Core\Request\Customers\CustomerDeleteRequest;
use Commercetools\Core\Request\DiscountCodes\DiscountCodeCreateRequest;
use Commercetools\Core\Request\DiscountCodes\DiscountCodeDeleteRequest;
use Commercetools\Core\Request\Payments\PaymentCreateRequest;
use Commercetools\Core\Request\Payments\PaymentDeleteRequest;
use Commercetools\Core\Request\ProductDiscounts\ProductDiscountCreateRequest;
use Commercetools\Core\Request\ProductDiscounts\ProductDiscountDeleteRequest;
use Commercetools\Core\Request\Products\Command\ProductPublishAction;
use Commercetools\Core\Request\Products\Command\ProductUnpublishAction;
use Commercetools\Core\Request\Products\ProductCreateRequest;
use Commercetools\Core\Request\Products\ProductDeleteRequest;
use Commercetools\Core\Request\Products\ProductUpdateRequest;
use Commercetools\Core\Request\ProductTypes\ProductTypeCreateRequest;
use Commercetools\Core\Request\ProductTypes\ProductTypeDeleteRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodCreateRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodDeleteRequest;
use Commercetools\Core\Request\ShoppingLists\ShoppingListCreateRequest;
use Commercetools\Core\Request\ShoppingLists\ShoppingListDeleteRequest;
use Commercetools\Core\Request\States\StateCreateRequest;
use Commercetools\Core\Request\States\StateDeleteRequest;
use Commercetools\Core\Request\Stores\StoreCreateRequest;
use Commercetools\Core\Request\Stores\StoreDeleteRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryCreateRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryDeleteRequest;
use Commercetools\Core\Request\Types\TypeCreateRequest;
use Commercetools\Core\Request\Types\TypeDeleteRequest;
use Commercetools\Core\Request\Zones\ZoneCreateRequest;
use Commercetools\Core\Request\Zones\ZoneDeleteRequest;
use Commercetools\Core\Model\Type\StringType as CustomStringType;

class TestHelper
{
    const RAND_MAX = 10000;
    private static $instance;

    private $client;

    private $testRun;

    /**
     * @var CartDiscount
     */
    private $cartDiscount;

    /**
     * @var DiscountCode
     */
    private $discountCode;

    /**
     * @var Type
     */
    private $type;

    /**
     * @var Product
     */
    private $product;

    /**
     * @var ProductType
     */
    private $productType;

    /**
     * @var Category
     */
    private $category;

    /**
     * @var TaxCategory
     */
    private $taxCategory;

    /**
     * @var string
     */
    private $region;

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
     * @var Payment
     */
    private $payment;

    /**
     * @var CustomerGroup
     */
    private $customerGroup;

    /**
     * @var Channel
     */
    private $channel;

    /**
     * @var Cart
     */
    private $cart;

    /**
     * @var ProductDiscount
     */
    private $productDiscount;

    /**
     * @var ShoppingList
     */
    private $shoppingList;

    /**
     * @var Store
     */
    private $store;

    /**
     * @var State
     */
    private $state1;

    /**
     * @var State
     */
    private $state2;

    /**
     * @var StateDeleteRequest[]
     */
    private $stateCleanupRequests;

    /**
     * TestHelper constructor.
     * @param $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * @param $client
     * @return TestHelper
     */
    public static function getInstance($client)
    {
        if (is_null(static::$instance)) {
            static::$instance = new self($client);
        }

        return static::$instance;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }


    public function getTestRun()
    {
        if (is_null($this->testRun)) {
            $this->testRun = md5(microtime());
        }

        return $this->testRun;
    }

    /**
     * @return DiscountCodeDraft
     */
    public function getDiscountCodeDraft($code = null)
    {
        if (is_null($code)) {
            $code = 'code';
        }
        $draft = DiscountCodeDraft::ofCodeDiscountsAndActive(
            'test-' . $this->getTestRun() . '-' . $code,
            CartDiscountReferenceCollection::of()->add($this->getCartDiscount()->getReference()),
            true
        );

        return $draft;
    }

    public function getDiscountCode()
    {
        if (is_null($this->discountCode)) {
            $draft = $this->getDiscountCodeDraft();
            $request = DiscountCodeCreateRequest::ofDraft($draft);
            $response = $request->executeWithClient($this->getClient());
            $this->discountCode = $request->mapResponse($response);
        }

        return $this->discountCode;
    }

    public function deleteDiscountCode()
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

    public function getCartDiscountDraft($name, $discountCodeRequired = true)
    {
        $draft = CartDiscountDraft::ofNameValuePredicateTargetOrderActiveAndDiscountCode(
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-' . $name),
            AbsoluteCartDiscountValue::of()->setMoney(
                MoneyCollection::of()->add(Money::ofCurrencyAndAmount('EUR', 100))
            ),
            '1=1',
            CartDiscountTarget::of()->setType('lineItems')->setPredicate('1=1'),
            '0.9' . trim((string)mt_rand(1, static::RAND_MAX), '0'),
            true,
            true
        );

        return $draft;
    }

    public function getCartDiscount($discountCodeRequired = true)
    {
        if (is_null($this->cartDiscount)) {
            $draft = $this->getCartDiscountDraft('discount', $discountCodeRequired);
            $request = CartDiscountCreateRequest::ofDraft($draft);
            $response = $request->executeWithClient($this->getClient());
            $this->cartDiscount = $request->mapResponse($response);
        }

        return $this->cartDiscount;
    }

    public function deleteCartDiscount()
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
     * @param CartDiscount $cartDiscount
     */
    public function setCartDiscount($cartDiscount)
    {
        $this->cartDiscount = $cartDiscount;
    }

    public function getGiftLineItemCartDiscount()
    {
        if (is_null($this->cartDiscount)) {
            $product = $this->getProduct();
            $draft = CartDiscountDraft::ofNameValuePredicateOrderActiveAndDiscountCode(
                LocalizedString::ofLangAndText(
                    'en',
                    'test-' . $this->getTestRun() . '-gift-line-item-discount'
                ),
                GiftLineItemCartDiscountValue::of()
                    ->setProduct($product->getReference())
                    ->setVariantId($product->getMasterData()->getCurrent()->getMasterVariant()->getId()),
                '1=1',
                '0.9' . trim((string)mt_rand(1, static::RAND_MAX), '0'),
                true,
                false
            );
            $request = CartDiscountCreateRequest::ofDraft($draft);
            $response = $request->executeWithClient($this->getClient());

            $this->cartDiscount = $request->mapResponse($response);
        }

        return $this->cartDiscount;
    }

    /**
     * @return State[]
     */
    public function createStates($type)
    {
        if (is_null($this->state1) && is_null($this->state2)) {
            $draft = StateDraft::ofKeyAndType(
                'test-' . $this->getTestRun() . '-key1',
                $type
            )->setInitial(true);
            $request = StateCreateRequest::ofDraft($draft);
            $response = $request->executeWithClient($this->getClient());
            $this->state1 = $state = $request->mapResponse($response);

            $this->stateCleanupRequests[] = StateDeleteRequest::ofIdAndVersion(
                $state->getId(),
                $state->getVersion()
            );

            $draft = StateDraft::ofKeyAndType(
                'test-' . $this->getTestRun() . '-key2',
                $type
            )->setTransitions(StateReferenceCollection::of()->add($this->state1->getReference()));
            $request = StateCreateRequest::ofDraft($draft);
            $response = $request->executeWithClient($this->getClient());
            $this->state2 = $state = $request->mapResponse($response);

            array_unshift($this->stateCleanupRequests, StateDeleteRequest::ofIdAndVersion(
                $state->getId(),
                $state->getVersion()
            ));
        }

        return [$this->state1, $this->state2];
    }

    public function deleteStates()
    {
        if (!empty($this->stateCleanupRequests)) {
            foreach ($this->stateCleanupRequests as $request) {
                $request->executeWithClient($this->getClient());
            }
        }
        $this->stateCleanupRequests = [];
        $this->state1 = null;
        $this->state2 = null;
    }

    public function getProductType()
    {
        if (is_null($this->productType)) {
            $productTypeDraft = ProductTypeDraft::ofNameAndDescription(
                'test-' . $this->getTestRun() . '-productType',
                'test-' . $this->getTestRun() . '-productType'
            )
                ->setAttributes(
                    AttributeDefinitionCollection::of()
                        ->add(
                            AttributeDefinition::of()
                                ->setName('testField')
                                ->setLabel(LocalizedString::ofLangAndText('en', 'testField'))
                                ->setIsRequired(false)
                                ->setAttributeConstraint('None')
                                ->setInputHint('SingleLine')
                                ->setIsSearchable(false)
                                ->setType(StringType::of())
                        )
                )
            ;
            $request = ProductTypeCreateRequest::ofDraft($productTypeDraft);
            $response = $request->executeWithClient($this->getClient());
            $this->productType = $request->mapResponse($response);
        }

        return $this->productType;
    }

    public function deleteProductType()
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
     * @param ProductType $productType
     */
    public function setProductType($productType)
    {
        $this->productType = $productType;
    }

    public function getCategory()
    {
        if (is_null($this->category)) {
            $draft = CategoryDraft::ofNameAndSlug(
                LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-category'),
                LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-category')
            );
            $request = CategoryCreateRequest::ofDraft($draft);
            $response = $request->executeWithClient($this->getClient());
            $this->category = $request->mapResponse($response);
        }

        return $this->category;
    }

    public function deleteCategory()
    {
        if (!is_null($this->category)) {
            $request = CategoryDeleteRequest::ofIdAndVersion(
                $this->category->getId(),
                $this->category->getVersion()
            );
            $request->executeWithClient($this->getClient());
        }

        $this->category = null;
    }

    /**
     * @param Category $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getTaxCategory()
    {
        if (is_null($this->taxCategory)) {
            $taxCategoryDraft = TaxCategoryDraft::ofNameAndRates(
                'test-' . $this->getTestRun() . '-name',
                TaxRateCollection::of()->add(
                    TaxRate::of()->setName('test-' . $this->getTestRun() . '-name')
                        ->setAmount((float)('0.2' . mt_rand(1, 100)))
                        ->setIncludedInPrice(true)
                        ->setCountry('DE')
                        ->setState($this->getRegion())
                )
            );
            $request = TaxCategoryCreateRequest::ofDraft($taxCategoryDraft);
            $response = $request->executeWithClient($this->getClient());
            $this->taxCategory = $request->mapResponse($response);
        }

        return $this->taxCategory;
    }

    public function deleteTaxCategory()
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

    public function getType($key, $type)
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
                            ->setType(CustomStringType::of())
                    )
            );
            $request = TypeCreateRequest::ofDraft($typeDraft);
            $response = $request->executeWithClient($this->getClient());
            $this->type = $request->mapResponse($response);
        }

        return $this->type;
    }

    public function deleteType()
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
     * @return ProductDraft
     */
    public function getProductDraft()
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
                            PriceDraft::ofMoneyAndCountry(
                                Money::ofCurrencyAndAmount('EUR', 100),
                                'DE'
                            )
                        )
                    )
            )
            ->setTaxCategory($this->getTaxCategory()->getReference())
        ;

        return $draft;
    }

    public function getProduct(ProductDraft $draft = null)
    {
        if (is_null($this->product)) {
            if (is_null($draft)) {
                $draft = $this->getProductDraft();
            }
            $request = ProductCreateRequest::ofDraft($draft);
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

    public function deleteProduct()
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

    /**
     * @param Product $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }

    /**
     * @return PaymentDraft
     */
    public function getPaymentDraft()
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

    public function getPayment()
    {
        if (is_null($this->payment)) {
            $draft = $this->getPaymentDraft();
            $request = PaymentCreateRequest::ofDraft($draft);
            $response = $request->executeWithClient($this->getClient());
            $this->payment = $request->mapResponse($response);
        }

        return $this->payment;
    }

    public function deletePayment()
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

    public function getProductDiscount(ProductDiscountValue $discountValue, $predicate = null)
    {
        if (is_null($this->productDiscount)) {
            $draft = ProductDiscountDraft::ofNameDiscountPredicateOrderAndActive(
                LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-discount'),
                $discountValue,
                !is_null($predicate) ? $predicate : '1=1',
                '0.9' . trim((string)mt_rand(1, static::RAND_MAX), '0'),
                true
            );
            $request = ProductDiscountCreateRequest::ofDraft($draft);
            $response = $request->executeWithClient($this->getClient());
            $this->productDiscount = $request->mapResponse($response);
        }

        return $this->productDiscount;
    }

    public function deleteProductDiscount()
    {
        if (!is_null($this->productDiscount)) {
            $request = ProductDiscountDeleteRequest::ofIdAndVersion(
                $this->productDiscount->getId(),
                $this->productDiscount->getVersion()
            );
            $request->executeWithClient($this->getClient());
        }
        $this->productDiscount = null;
    }

    public function getRegion()
    {
        if (is_null($this->region)) {
            $this->region = "r" . (string)mt_rand(1, static::RAND_MAX);
        }

        return $this->region;
    }

    public function getZone()
    {
        if (is_null($this->zone)) {
            $zoneDraft = ZoneDraft::ofNameAndLocations(
                'test-' . $this->getTestRun() . '-name',
                LocationCollection::of()->add(
                    Location::of()->setCountry('DE')->setState($this->getRegion())
                )
            );
            $request = ZoneCreateRequest::ofDraft($zoneDraft);
            $response = $request->executeWithClient($this->getClient());
            $this->zone = $request->mapResponse($response);
        }

        return $this->zone;
    }

    public function deleteZone()
    {
        if (!is_null($this->zone)) {
            $request = ZoneDeleteRequest::ofIdAndVersion(
                $this->zone->getId(),
                $this->zone->getVersion()
            );
            $request->executeWithClient($this->getClient());
        }
        $this->zone = null;
    }

    /**
     * @param $name
     * @return ShippingMethodDraft
     */
    public function getShippingMethodDraft($name)
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

    public function getShippingMethod()
    {
        if (is_null($this->shippingMethod)) {
            $draft = $this->getShippingMethodDraft('cart');
            $request = ShippingMethodCreateRequest::ofDraft($draft);
            $response = $request->executeWithClient($this->getClient());
            $this->shippingMethod = $request->mapResponse($response);
        }

        return $this->shippingMethod;
    }

    public function deleteShippingMethod()
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
    public function getCustomerDraft()
    {
        $draft = CustomerDraft::ofEmailNameAndPassword(
            'TEST-' . $this->getTestRun() . '-em.ail+sphere@example.org',
            'test-' . $this->getTestRun() . '-firstName',
            'test-' . $this->getTestRun() . '-lastName',
            'test-' . $this->getTestRun() . '-password'
        );
        $draft
            ->setAddresses(
                AddressCollection::of()->add(
                    Address::of()
                        ->setCountry('DE')
                        ->setState($this->getRegion())
                )
            )
            ->setDefaultBillingAddress(0)
            ->setDefaultShippingAddress(0)
        ;

        return $draft;
    }

    public function getCustomer($draft = null)
    {
        if (is_null($this->customer)) {
            if (is_null($draft)) {
                $draft = $this->getCustomerDraft();
            }
            $request = CustomerCreateRequest::ofDraft($draft);
            $response = $request->executeWithClient($this->getClient());
            $result = $request->mapResponse($response);
            $this->customer = $result->getCustomer();
        }

        return $this->customer;
    }

    public function deleteCustomer()
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

    /**
     * @param Customer $customer
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    /**
     * @param $name
     * @return CustomerGroupDraft
     */
    public function getCustomerGroupDraft($name)
    {
        $draft = CustomerGroupDraft::ofGroupName(
            'test-' . $this->getTestRun() . '-' . $name
        );

        return $draft;
    }

    public function getCustomerGroup()
    {
        if (is_null($this->customerGroup)) {
            $draft = $this->getCustomerGroupDraft('group');
            $request = CustomerGroupCreateRequest::ofDraft($draft);
            $response = $request->executeWithClient($this->getClient());
            $this->customerGroup = $request->mapResponse($response);
        }

        return $this->customerGroup;
    }

    public function deleteCustomerGroup()
    {
        if (!is_null($this->customerGroup)) {
            $request = CustomerGroupDeleteRequest::ofIdAndVersion(
                $this->customerGroup->getId(),
                $this->customerGroup->getVersion()
            );
            $request->executeWithClient($this->getClient());
        }

        $this->customerGroup = null;
    }

    /**
     * @return ChannelDraft
     */
    public function getChannelDraft()
    {
        $draft = ChannelDraft::ofKey(
            'test-' . $this->getTestRun() . '-key'
        );

        return $draft;
    }

    public function getChannel($roles = null)
    {
        if (is_null($this->channel)) {
            $draft = $this->getChannelDraft();
            if (is_array($roles)) {
                $draft->setRoles($roles);
            }
            $request = ChannelCreateRequest::ofDraft($draft);
            $response = $request->executeWithClient($this->getClient());
            $this->channel = $request->mapResponse($response);
        }

        return $this->channel;
    }

    public function deleteChannel()
    {
        if (!is_null($this->channel)) {
            $request = ChannelDeleteRequest::ofIdAndVersion(
                $this->channel->getId(),
                $this->channel->getVersion()
            );
            $request->executeWithClient($this->getClient());
            $this->channel = null;
        }
    }

    /**
     * @return CartDraft
     */
    public function getCartDraft()
    {
        $draft = CartDraft::ofCurrencyAndCountry('EUR', 'DE');

        return $draft;
    }

    public function getCart(CartDraft $draft = null)
    {
        if (is_null($this->cart)) {
            if (is_null($draft)) {
                $draft = $this->getCartDraft();
            }
            $request = CartCreateRequest::ofDraft($draft);
            $response = $request->executeWithClient($this->getClient());
            $this->cart = $request->mapResponse($response);
        }

        return $this->cart;
    }

    public function deleteCart()
    {
        if (!is_null($this->cart)) {
            $request = CartDeleteRequest::ofIdAndVersion(
                $this->cart->getId(),
                $this->cart->getVersion()
            );
            $request->executeWithClient($this->getClient());
            $this->cart = null;
        }
    }

    /**
     * @return ShoppingListDraft
     */
    public function getShoppingListDraft($name = null)
    {
        $draft = ShoppingListDraft::ofNameAndKey(
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-' . $name),
            'key-' . $this->getTestRun()
        );

        return $draft;
    }

    public function getShoppingList(ShoppingListDraft $draft = null)
    {
        if (is_null($this->shoppingList)) {
            if (is_null($draft)) {
                $draft = $this->getShoppingListDraft();
            }
            $request = ShoppingListCreateRequest::ofDraft($draft);
            $response = $request->executeWithClient($this->getClient());
            $this->shoppingList = $request->mapResponse($response);
        }

        return $this->shoppingList;
    }

    public function deleteShoppingList()
    {
        if (!is_null($this->shoppingList)) {
            $request = ShoppingListDeleteRequest::ofIdAndVersion(
                $this->shoppingList->getId(),
                $this->shoppingList->getVersion()
            );
            $request->executeWithClient($this->getClient());
            $this->shoppingList = null;
        }
    }

    /**
     * @return StoreDraft
     */
    public function getStoreDraft($name = null)
    {
        $draft = StoreDraft::ofKeyAndName(
            'key-' . $this->getTestRun(),
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-' . $name)
        );

        return $draft;
    }

    public function getStore(StoreDraft $draft = null)
    {
        if (is_null($this->store)) {
            if (is_null($draft)) {
                $draft = $this->getStoreDraft();
            }
            $request = StoreCreateRequest::ofDraft($draft);
            $response = $request->executeWithClient($this->getClient());
            $this->store = $request->mapResponse($response);
        }

        return $this->store;
    }

    public function deleteStore()
    {
        if (!is_null($this->store)) {
            $request = StoreDeleteRequest::ofIdAndVersion(
                $this->store->getId(),
                $this->store->getVersion()
            );
            $request->executeWithClient($this->getClient());
            $this->store = null;
        }
    }
}
