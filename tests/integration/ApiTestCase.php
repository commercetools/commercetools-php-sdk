<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core;

use Cache\Adapter\Filesystem\FilesystemCachePool;
use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Model\Cart\CartDraft;
use Commercetools\Core\Model\CartDiscount\CartDiscount;
use Commercetools\Core\Model\CartDiscount\CartDiscountDraft;
use Commercetools\Core\Model\CartDiscount\CartDiscountReferenceCollection;
use Commercetools\Core\Model\CartDiscount\CartDiscountTarget;
use Commercetools\Core\Model\CartDiscount\CartDiscountValue;
use Commercetools\Core\Model\Category\Category;
use Commercetools\Core\Model\Category\CategoryDraft;
use Commercetools\Core\Model\Channel\Channel;
use Commercetools\Core\Model\Channel\ChannelDraft;
use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\AddressCollection;
use Commercetools\Core\Model\Common\Context;
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
use Commercetools\Core\Model\State\State;
use Commercetools\Core\Model\State\StateDraft;
use Commercetools\Core\Model\State\StateReferenceCollection;
use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Model\TaxCategory\TaxCategoryDraft;
use Commercetools\Core\Model\TaxCategory\TaxRate;
use Commercetools\Core\Model\TaxCategory\TaxRateCollection;
use Commercetools\Core\Model\Type\FieldDefinition;
use Commercetools\Core\Model\Type\FieldDefinitionCollection;
use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Model\Type\StringType as CustomStringType;
use Commercetools\Core\Model\Type\TypeDraft;
use Commercetools\Core\Model\Zone\Location;
use Commercetools\Core\Model\Zone\LocationCollection;
use Commercetools\Core\Model\Zone\Zone;
use Commercetools\Core\Model\Zone\ZoneDraft;
use Commercetools\Core\Request\AbstractDeleteRequest;
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
use Commercetools\Core\Request\States\StateCreateRequest;
use Commercetools\Core\Request\States\StateDeleteRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryCreateRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryDeleteRequest;
use Commercetools\Core\Request\Types\TypeCreateRequest;
use Commercetools\Core\Request\Types\TypeDeleteRequest;
use Commercetools\Core\Request\Zones\ZoneCreateRequest;
use Commercetools\Core\Request\Zones\ZoneDeleteRequest;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Monolog\Handler\ErrorLogHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;
use Psr\Log\LogLevel;
use Symfony\Component\Yaml\Yaml;

class ApiTestCase extends TestCase
{
    private static $testRun;
    private static $client = [];

    protected $cleanupRequests = [];

    /**
     * @var ProductType
     */
    protected $productType;

    /**
     * @var AbstractDeleteRequest
     */
    protected $deleteRequest;

    /**
     * @var Category
     */
    protected $category;

    /**
     * @var TaxCategory
     */
    private $taxCategory;

    /**
     * @var string
     */
    private $region;

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
     * @var Type
     */
    private $type;

    /**
     * @var Product
     */
    protected $product;

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
    protected $customer;

    /**
     * @var Payment
     */
    private $payment;

    /**
     * @var CartDiscount
     */
    protected $cartDiscount;

    /**
     * @var DiscountCode
     */
    private $discountCode;

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

    private $logger;

    private $cache;

    public function setUp()
    {
        self::$testRun = md5(microtime());
    }

    public function getTestRun()
    {
        if (is_null(self::$testRun)) {
            self::$testRun = md5(microtime());
        }

        return self::$testRun;
    }

    public function tearDown()
    {
        $this->cleanup();
    }

    /**
     * @param $scope
     * @return Config
     */
    public function getClientConfig($scope)
    {
        $context = Context::of()->setGraceful(false)->setLanguages(['en'])->setLocale('en_US');
        if (file_exists(__DIR__ . '/../myapp.yml')) {
            $appConfig = Yaml::parse(file_get_contents(__DIR__ . '/../myapp.yml'));
            $parameters = [];
            foreach ($appConfig['parameters'] as $key => $parameter) {
                $parts = explode('-', $key);
                if (count($parts) == 1) {
                    $parameters[$key] = $parameter;
                }
            }
            $config = Config::fromArray($parameters);
            if (is_string($scope)
                && isset($appConfig['parameters'][$scope . '-client_id'])
                && isset($appConfig['parameters'][$scope . '-client_secret'])
            ) {
                $config->setClientId($appConfig['parameters'][$scope . '-client_id']);
                $config->setClientSecret($appConfig['parameters'][$scope . '-client_secret']);
            }
        } else {
            $config = Config::fromArray([
                'client_id' => $_SERVER['COMMERCETOOLS_CLIENT_ID'],
                'client_secret' => $_SERVER['COMMERCETOOLS_CLIENT_SECRET'],
                'project' => $_SERVER['COMMERCETOOLS_PROJECT']
            ]);
        }
        $config->setContext($context);
        $config->setScope($scope);
        $config = $this->getAcceptEncoding($config);

        return $config;
    }

    protected function getLogger()
    {
        if (is_null($this->logger)) {
            if (file_exists(__DIR__ .'/requests.log')) {
                file_put_contents(__DIR__ .'/requests.log', "");
            }
            $loggerOut = getenv('LOGGER_OUT');

            $this->logger = new Logger('test');
            if ($loggerOut == 'CLI') {
                $this->logger->pushHandler(new ErrorLogHandler());
            } else {
                $this->logger->pushHandler(new StreamHandler(__DIR__ .'/requests.log', LogLevel::NOTICE));
            }

        }

        return $this->logger;
    }

    protected function getCache()
    {
        if (is_null($this->cache)) {
            $filesystemAdapter = new Local(realpath(__DIR__ . '/../..'));
            $filesystem        = new Filesystem($filesystemAdapter);
            $this->cache = new FilesystemCachePool($filesystem);
        }

        return $this->cache;
    }

    /**
     * @param string $scope
     * @param Config $config
     * @return \Commercetools\Core\Client
     */
    public function getClient($scope = 'manage_project')
    {
        if (!isset(self::$client[$scope])) {
            $config = $this->getClientConfig($scope);

            self::$client[$scope] = Client::ofConfigCacheAndLogger($config, $this->getCache(), $this->getLogger());
            self::$client[$scope]->getOauthManager()->getHttpClient(['verify' => $this->getVerifySSL()]);
            self::$client[$scope]->getHttpClient(['verify' => $this->getVerifySSL()]);
        }

        return self::$client[$scope];
    }

    protected function getVerifySSL()
    {
        $verifySSL = getenv('PHP_SDK_IT_SSL_VERIFY');
        return ($verifySSL !== 'false');
    }

    protected function getAcceptEncoding(Config $config)
    {
        $disableGZIP = getenv('PHP_SDK_DISABLE_GZIP');
        if ($disableGZIP === 'true') {
            $config->setAcceptEncoding(null);
        }
        return $config;
    }

    protected function cleanup()
    {
        if (count($this->cleanupRequests) > 0) {
            foreach ($this->cleanupRequests as $request) {
                $this->getClient()->addBatchRequest($request);
            }
            $this->getClient()->executeBatch();
            unset($this->cleanupRequests);
            $this->cleanupRequests = [];
        }

        $this->deleteCart();
        $this->deleteProduct();
        $this->deleteCustomer();
        $this->deleteCustomerGroup();
        $this->deleteCategory();
        $this->deleteShippingMethod();
        $this->deleteTaxCategory();
        $this->deleteZone();
        $this->deletePayment();
        $this->deleteDiscountCode();
        $this->deleteCartDiscount();
        $this->deleteProductType();
        $this->deleteProductDiscount();
        $this->deleteType();
        $this->deleteChannel();
        $this->deleteStates();
    }

    protected function map(callable $callback, $collection)
    {
        $result = [];
        foreach ($collection as $item) {
            $result[] = $callback($item);
        }

        return $result;
    }

    protected function getRegion()
    {
        if (is_null($this->region)) {
            $this->region = (string)mt_rand(1, 1000);
        }

        return $this->region;
    }

    protected function getProductType()
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

    private function deleteProductType()
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

    protected function getCategory()
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

    private function deleteCategory()
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

    protected function getTaxCategory()
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

    /**
     * @return State[]
     */
    protected function createStates($type)
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

    private function deleteStates()
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

    protected function getType($key, $type)
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

    protected function getProduct(ProductDraft $draft = null)
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

    private function deletePayment()
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

    private function deleteCartDiscount()
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

    protected function getProductDiscount(ProductDiscountValue $discountValue)
    {
        if (is_null($this->productDiscount)) {
            $draft = ProductDiscountDraft::ofNameDiscountPredicateOrderAndActive(
                LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-discount'),
                $discountValue,
                '1=1',
                '0.9' . trim((string)mt_rand(1, 1000), '0'),
                true
            );
            $request = ProductDiscountCreateRequest::ofDraft($draft);
            $response = $request->executeWithClient($this->getClient());
            $this->productDiscount = $request->mapResponse($response);
        }

        return $this->productDiscount;
    }

    private function deleteProductDiscount()
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

    private function deleteDiscountCode()
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

    protected function getZone()
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

    protected function getCustomer($draft = null)
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

    private function deleteCustomer()
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
     * @param $name
     * @return CustomerGroupDraft
     */
    protected function getCustomerGroupDraft($name)
    {
        $draft = CustomerGroupDraft::ofGroupName(
            'test-' . $this->getTestRun() . '-' . $name
        );

        return $draft;
    }

    protected function getCustomerGroup()
    {
        if (is_null($this->customerGroup)) {
            $draft = $this->getCustomerGroupDraft('group');
            $request = CustomerGroupCreateRequest::ofDraft($draft);
            $response = $request->executeWithClient($this->getClient());
            $this->customerGroup = $request->mapResponse($response);
        }

        return $this->customerGroup;
    }

    protected function deleteCustomerGroup()
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
    protected function getChannelDraft()
    {
        $draft = ChannelDraft::ofKey(
            'test-' . $this->getTestRun() . '-key'
        );

        return $draft;
    }

    protected function getChannel($roles = null)
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

    protected function deleteChannel()
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
    protected function getCartDraft()
    {
        $draft = CartDraft::ofCurrency('EUR')->setCountry('DE');

        return $draft;
    }

    protected function getCart(CartDraft $draft = null)
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

    protected function deleteCart()
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
}
