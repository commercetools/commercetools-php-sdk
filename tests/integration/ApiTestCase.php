<?php
/** @noinspection PhpLanguageLevelInspection */
declare(strict_types=1);

namespace Commercetools\Core\IntegrationTests;

use Cache\Adapter\Filesystem\FilesystemCachePool;
use Commercetools\Core\Client;
use Commercetools\Core\Client\ClientFactory;
use Commercetools\Core\Client\ProviderFactory;
use Commercetools\Core\Client\OAuth\AnonymousIdProvider;
use Commercetools\Core\Config;
use Commercetools\Core\Error\ApiServiceException;
use Commercetools\Core\Error\ServiceUnavailableException;
use Commercetools\Core\Fixtures\EventuallyException;
use Commercetools\Core\Fixtures\InstanceTokenStorage;
use Commercetools\Core\Fixtures\ManuelActivationStrategy;
use Commercetools\Core\Fixtures\ProfilerMiddleware;
use Commercetools\Core\Fixtures\TeamCityFormatter;
use Commercetools\Core\Fixtures\TimingProfiler;
use Commercetools\Core\IntegrationTests\Project\ProjectFixture;
use Commercetools\Core\Model\Cart\CartDraft;
use Commercetools\Core\Model\Channel\ChannelDraft;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Customer\CustomerDraft;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupDraft;
use Commercetools\Core\Model\DiscountCode\DiscountCodeDraft;
use Commercetools\Core\Model\Payment\PaymentDraft;
use Commercetools\Core\Model\Product\ProductDraft;
use Commercetools\Core\Model\ProductDiscount\ProductDiscountValue;
use Commercetools\Core\Model\Project\Project;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodDraft;
use Commercetools\Core\Model\ShoppingList\ShoppingListDraft;
use Commercetools\Core\Model\State\State;
use Commercetools\Core\Model\Store\StoreDraft;
use Commercetools\Core\Request\AbstractDeleteRequest;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Middleware;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Monolog\Handler\ErrorLogHandler;
use Monolog\Handler\FingersCrossedHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LogLevel;
use Symfony\Component\Stopwatch\Stopwatch;
use Symfony\Component\Yaml\Yaml;
use GuzzleHttp\Client as HttpClient;

class ApiTestCase extends TestCase
{
    private static $testRun;
    private static $client = [];
    private static $apiClient = [];
    private static $errorHandler;
    private static $profiler;
    /**
     * @var Project
     */
    private static $project;

    protected $cleanupRequests = [];

    /**
     * @var AbstractDeleteRequest
     */
    protected $deleteRequest;

    private $logger;

    private $cache;

    public function setUp(): void
    {
        if (self::$errorHandler instanceof FingersCrossedHandler) {
            self::$errorHandler->clear();
        }
        self::$testRun = md5(microtime());
        $this->setupProject();
    }

    public function getTestRun()
    {
        if (is_null(self::$testRun)) {
            self::$testRun = md5(microtime());
        }

        return self::$testRun;
    }

    public function tearDown(): void
    {
        $this->cleanup();
    }

    public function flushErrorLog()
    {
        if (self::$errorHandler instanceof FingersCrossedHandler) {
            self::$errorHandler->activate();
        }
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
//        if (getenv('TEAMCITY_FORMATTER') == "true") {
//            $config->setMessageFormatter(new MessageFormatter(self::TEAMCITY_LF));
//        }
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
                $this->logger->pushHandler($this->getCliHandler());
            } else {
                $this->logger->pushHandler(new StreamHandler(__DIR__ .'/requests.log', LogLevel::INFO));
            }
        }

        return $this->logger;
    }

    public function getCliHandler()
    {
        if (is_null(self::$errorHandler)) {
            $handler = new ErrorLogHandler();
            if (getenv("TEAMCITY_FORMATTER") == "true") {
                $handler->setFormatter(new TeamCityFormatter());
            }
            $handler = new FingersCrossedHandler($handler, new ManuelActivationStrategy());
            self::$errorHandler = $handler;
        }

        return self::$errorHandler;
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
     * @return \Commercetools\Core\Client
     */
    public function getClient($scope = 'manage_project')
    {
        if (!isset(self::$client[$scope])) {
            $config = $this->getClientConfig($scope);
            $config->setOAuthClientOptions(['verify' => $this->getVerifySSL(), 'timeout' => '15']);
            $config->setClientOptions(['verify' => $this->getVerifySSL(), 'timeout' => '15']);

            $client = Client::ofConfigCacheAndLogger($config, $this->getCache(), $this->getLogger());
            $enableProfiler = getenv('PHP_SDK_PROFILE');
            if ($enableProfiler === 'true') {
                $client->getHttpClient()->addHandler($this->getProfiler());
            }

            self::$client[$scope] = $client;
        }

        return self::$client[$scope];
    }

    /**
     * @param string $scope
     * @return Client\ApiClient
     */
    public function getApiClient($scope = 'manage_project')
    {
        if (!isset(self::$apiClient[$scope])) {
            $config = $this->getClientConfig($scope);
            $config->setThrowExceptions(true);
            $config->setOAuthClientOptions(['verify' => $this->getVerifySSL(), 'timeout' => '15']);

            $maxRetries = 3;
            $clientOptions = [
                'verify' => $this->getVerifySSL(),
                'timeout' => '15',
                'middlewares' => [
                    'retry' => Middleware::retry(function ($retries, RequestInterface $request, ResponseInterface $response = null, $error = null) use ($maxRetries) {
                        if ($response instanceof ResponseInterface && $response->getStatusCode() < 500) {
                            return false;
                        }
                        if ($retries > $maxRetries) {
                            return false;
                        }
                        if ($error instanceof ServiceUnavailableException) {
                            return true;
                        }
                        if ($error instanceof ServerException && $error->getCode() == 503) {
                            return true;
                        }
                        if ($response instanceof ResponseInterface && $response->getStatusCode() == 503) {
                            return true;
                        }
                        return false;
                    })
                ]
            ];
            $enableProfiler = getenv('PHP_SDK_PROFILE');
            if ($enableProfiler === 'true') {
                $clientOptions['middlewares'][] = $this->getProfiler();
            }
            $config->setClientOptions($clientOptions);

            $client = ClientFactory::of()->createClient($config, $this->getLogger());

            self::$apiClient[$scope] = $client;
        }

        return self::$apiClient[$scope];
    }

    private function getProfiler()
    {
        if (is_null(self::$profiler)) {
            self::$profiler = new TimingProfiler(__DIR__ .'/profile.csv');
        }
        return new ProfilerMiddleware(
            self::$profiler,
            new Stopwatch()
        );
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

    protected function setupProject()
    {
        if (is_null(self::$project)) {
            $project = ProjectFixture::setupProject($this->getApiClient());

            self::$project = $project;
        }
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
        $this->deleteShoppingList();
        $this->deleteStore();
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
        return TestHelper::getInstance($this->getClient())->getRegion();
    }

    protected function getProductType()
    {
        return TestHelper::getInstance($this->getClient())->getProductType();
    }

    private function deleteProductType()
    {
        TestHelper::getInstance($this->getClient())->deleteProductType();
    }

    protected function getCategory()
    {
        return TestHelper::getInstance($this->getClient())->getCategory();
    }

    private function deleteCategory()
    {
        TestHelper::getInstance($this->getClient())->deleteCategory();
    }

    protected function getTaxCategory()
    {
        return TestHelper::getInstance($this->getClient())->getTaxCategory();
    }

    private function deleteTaxCategory()
    {
        TestHelper::getInstance($this->getClient())->deleteTaxCategory();
    }

    /**
     * @return State[]
     */
    protected function createStates($type)
    {
        return TestHelper::getInstance($this->getClient())->createStates($type);
    }

    private function deleteStates()
    {
        TestHelper::getInstance($this->getClient())->deleteStates();
    }

    protected function getType($key, $type)
    {
        return TestHelper::getInstance($this->getClient())->getType($key, $type);
    }

    private function deleteType()
    {
        TestHelper::getInstance($this->getClient())->deleteType();
    }

    /**
     * @return ProductDraft
     */
    protected function getProductDraft()
    {
        return TestHelper::getInstance($this->getClient())->getProductDraft();
    }

    protected function getProduct(ProductDraft $draft = null)
    {
        return TestHelper::getInstance($this->getClient())->getProduct($draft);
    }

    protected function deleteProduct()
    {
        TestHelper::getInstance($this->getClient())->deleteProduct();
    }

    /**
     * @return PaymentDraft
     */
    protected function getPaymentDraft()
    {
        return TestHelper::getInstance($this->getClient())->getPaymentDraft();
    }

    protected function getPayment()
    {
        return TestHelper::getInstance($this->getClient())->getPayment();
    }

    private function deletePayment()
    {
        TestHelper::getInstance($this->getClient())->deletePayment();
    }

    protected function getCartDiscountDraft($name, $discountCodeRequired = true)
    {
        return TestHelper::getInstance($this->getClient())->getCartDiscountDraft($name, $discountCodeRequired);
    }

    protected function getCartDiscount($discountCodeRequired = true)
    {
        return TestHelper::getInstance($this->getClient())->getCartDiscount($discountCodeRequired);
    }

    protected function getGiftLineItemCartDiscount()
    {
        return TestHelper::getInstance($this->getClient())->getGiftLineItemCartDiscount();
    }

    private function deleteCartDiscount()
    {
        TestHelper::getInstance($this->getClient())->deleteCartDiscount();
    }

    protected function getProductDiscount(ProductDiscountValue $discountValue, $predicate = null)
    {
        return TestHelper::getInstance($this->getClient())->getProductDiscount($discountValue, $predicate);
    }

    private function deleteProductDiscount()
    {
        TestHelper::getInstance($this->getClient())->deleteProductDiscount();
    }

    /**
     * @return DiscountCodeDraft
     */
    protected function getDiscountCodeDraft($code = null)
    {
        return TestHelper::getInstance($this->getClient())->getDiscountCodeDraft($code);
    }

    protected function getDiscountCode()
    {
        return TestHelper::getInstance($this->getClient())->getDiscountCode();
    }

    private function deleteDiscountCode()
    {
        TestHelper::getInstance($this->getClient())->deleteDiscountCode();
    }

    protected function getZone()
    {
        return TestHelper::getInstance($this->getClient())->getZone();
    }

    private function deleteZone()
    {
        TestHelper::getInstance($this->getClient())->deleteZone();
    }

    /**
     * @param $name
     * @return ShippingMethodDraft
     */
    protected function getShippingMethodDraft($name)
    {
        return TestHelper::getInstance($this->getClient())->getShippingMethodDraft($name);
    }

    protected function getShippingMethod()
    {
        return TestHelper::getInstance($this->getClient())->getShippingMethod();
    }

    private function deleteShippingMethod()
    {
        TestHelper::getInstance($this->getClient())->deleteShippingMethod();
    }

    /**
     * @return CustomerDraft
     */
    protected function getCustomerDraft()
    {
        return TestHelper::getInstance($this->getClient())->getCustomerDraft();
    }

    protected function getCustomer($draft = null)
    {
        return TestHelper::getInstance($this->getClient())->getCustomer($draft);
    }

    private function deleteCustomer()
    {
        TestHelper::getInstance($this->getClient())->deleteCustomer();
    }

    /**
     * @param $name
     * @return CustomerGroupDraft
     */
    protected function getCustomerGroupDraft($name)
    {
        return TestHelper::getInstance($this->getClient())->getCustomerGroupDraft($name);
    }

    protected function getCustomerGroup()
    {
        return TestHelper::getInstance($this->getClient())->getCustomerGroup();
    }

    protected function deleteCustomerGroup()
    {
        TestHelper::getInstance($this->getClient())->deleteCustomerGroup();
    }

    /**
     * @return ChannelDraft
     */
    protected function getChannelDraft()
    {
        return TestHelper::getInstance($this->getClient())->getChannelDraft();
    }

    protected function getChannel($roles = null)
    {
        return TestHelper::getInstance($this->getClient())->getChannel($roles);
    }

    protected function deleteChannel()
    {
        TestHelper::getInstance($this->getClient())->deleteChannel();
    }

    /**
     * @return CartDraft
     */
    protected function getCartDraft()
    {
        return TestHelper::getInstance($this->getClient())->getCartDraft();
    }

    protected function getCart(CartDraft $draft = null)
    {
        return TestHelper::getInstance($this->getClient())->getCart($draft);
    }

    protected function deleteCart()
    {
        TestHelper::getInstance($this->getClient())->deleteCart();
    }

    /**
     * @return ShoppingListDraft
     */
    protected function getShoppingListDraft($name = null)
    {
        return TestHelper::getInstance($this->getClient())->getShoppingListDraft($name);
    }

    protected function getShoppingList(ShoppingListDraft $draft = null)
    {
        return TestHelper::getInstance($this->getClient())->getShoppingList($draft);
    }

    protected function deleteShoppingList()
    {
        TestHelper::getInstance($this->getClient())->deleteShoppingList();
    }

    /**
     * @return StoreDraft
     */
    protected function getStoreDraft($name = null)
    {
        return TestHelper::getInstance($this->getClient())->getStoreDraft($name);
    }

    protected function getStore(StoreDraft $draft = null)
    {
        return TestHelper::getInstance($this->getClient())->getStore($draft);
    }

    protected function deleteStore()
    {
        TestHelper::getInstance($this->getClient())->deleteStore();
    }

    public function getAnonymousMeClient(AnonymousIdProvider $anonymousIdProvider = null)
    {
        $config = $this->getClientConfig(['view_products', 'manage_my_profile', 'manage_my_orders', 'manage_my_shopping_lists', 'create_anonymous_token']);

        $provider = ProviderFactory::of()->createTokenStorageProviderFor($config, new HttpClient(), new InstanceTokenStorage(), $anonymousIdProvider);
        return ClientFactory::of()->createClient($config, $this->getLogger(), $this->getCache(), $provider);
    }

    public function getCustomerMeClient()
    {
        $customerDraft = $this->getCustomerDraft();
        $this->getCustomer($customerDraft);

        $storage = new InstanceTokenStorage();
        $config = $this->getClientConfig(['view_products', 'manage_my_profile', 'manage_my_orders', 'manage_my_shopping_lists', 'create_anonymous_token']);
        $provider = ProviderFactory::of()->createPasswordFlowProviderFor($config, new HttpClient(), $storage);
        $provider->getTokenFor($customerDraft->getEmail(), $customerDraft->getPassword());

        $provider = ProviderFactory::of()->createTokenStorageProviderFor($config, new HttpClient(), $storage);
        return ClientFactory::of()->createClient($config, $this->getLogger(), $this->getCache(), $provider);
    }

    protected function execute(Client\ApiClient $client, $request, array $headers = null)
    {
        try {
            $response = $client->execute($request, $headers);
        } catch (ApiServiceException $e) {
            throw ResourceFixture::toFixtureException($e);
        }

        return $response;
    }

    protected function eventually(callable $eventuallyFunction, $maxRetries = 30)
    {
        $retries = 0;
        do {
            $result = null;
            $retries++;
            try {
                $result = $eventuallyFunction();
            } catch (\Exception $e) {
                sleep(1);
            }
        } while ($result == null && $retries <= $maxRetries);

        if (is_null($result)) {
            throw new EventuallyException("Timeout eventually block", $e->getCode(), $e);
        }
        return $result;
    }

    protected function exceptionEventually(callable $eventuallyFunction, $maxRetries = 30)
    {
        $retries = 0;
        do {
            $retries++;
            try {
                $eventuallyFunction();
            } catch (\Exception $e) {
                sleep(1);
            }
        } while ($e == null && $retries <= $maxRetries);

        if (is_null($e)) {
            throw new EventuallyException("Timeout eventually block", $e->getCode(), $e);
        }
        throw $e;
    }
}
