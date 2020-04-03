<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\Errors;

use Cache\Adapter\PHPArray\ArrayCachePool;
use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Cache\CacheAdapterInterface;
use Commercetools\Core\Client;
use Commercetools\Core\Client\OAuth\Manager;
use Commercetools\Core\Error\AccessDeniedError;
use Commercetools\Core\Error\ApiException;
use Commercetools\Core\Error\ErrorContainer;
use Commercetools\Core\Error\InvalidTokenError;
use Commercetools\Core\Fixtures\FixtureException;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\IntegrationTests\Cart\CartFixture;
use Commercetools\Core\IntegrationTests\Category\CategoryFixture;
use Commercetools\Core\IntegrationTests\Customer\CustomerFixture;
use Commercetools\Core\IntegrationTests\Product\ProductFixture;
use Commercetools\Core\IntegrationTests\ProductType\ProductTypeFixture;
use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Model\Category\Category;
use Commercetools\Core\Model\Common\Attribute;
use Commercetools\Core\Model\Common\AttributeCollection;
use Commercetools\Core\Model\Common\Enum;
use Commercetools\Core\Model\Common\EnumCollection;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\PriceDraft;
use Commercetools\Core\Model\Common\PriceDraftCollection;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Model\Order\OrderCollection;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Model\Product\ProductCollection;
use Commercetools\Core\Model\Product\ProductDraft;
use Commercetools\Core\Model\Product\ProductVariantDraft;
use Commercetools\Core\Model\ProductType\AttributeDefinition;
use Commercetools\Core\Model\ProductType\EnumType;
use Commercetools\Core\Model\ProductType\ProductType;
use Commercetools\Core\Model\ProductType\StringType;
use Commercetools\Core\Request\Carts\Command\CartAddLineItemAction;
use Commercetools\Core\Request\Categories\Command\CategoryChangeNameAction;
use Commercetools\Core\Request\Products\Command\ProductAddPriceAction;
use Commercetools\Core\Request\Products\Command\ProductAddVariantAction;
use Commercetools\Core\Request\Products\ProductUpdateRequest;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeAddAttributeDefinitionAction;
use Commercetools\Core\Request\PsrRequest;
use Commercetools\Core\Response\ErrorResponse;
use GuzzleHttp\Psr7\Request;

class ErrorResponseTest extends ApiTestCase
{
    public function testCorrelationId()
    {
        $client = $this->getApiClient();

        $t = '00000000-0000-0000-0000-000000000000';

        $request = ProductUpdateRequest::ofIdAndVersion($t, 1);
        $httpResponse = $client->execute($request, [], ['http_errors' => false]);
        $response = $request->buildResponse($httpResponse);

        $this->assertIsString($response->getCorrelationId());
        $this->assertNotEmpty($response->getCorrelationId());
    }

    public function testNarrowedScope()
    {
        $client = $this->getApiClient('view_orders');

        $request = RequestBuilder::of()->orders()->query()->limit(1);
        $orders = $request->mapFromResponse($client->execute($request));
        $this->assertInstanceOf(OrderCollection::class, $orders);

        $this->expectException(ApiException::class);
        $this->expectExceptionCode(403);

        $request = RequestBuilder::of()->products()->query()->limit(1);
        $client->execute($request);
    }

    public function testNarrowedScopeSuccess()
    {
        $client = $this->getApiClient('view_products view_orders');

        $request = RequestBuilder::of()->products()->query()->limit(1);
        $products = $request->mapFromResponse($client->execute($request));

        $this->assertInstanceOf(ProductCollection::class, $products);

        $request = RequestBuilder::of()->orders()->query()->limit(1);
        $orders = $request->mapFromResponse($client->execute($request));

        $this->assertInstanceOf(OrderCollection::class, $orders);
    }

    public function testConcurrentModification()
    {
        $client = $this->getApiClient();

        CategoryFixture::withCategory(
            $client,
            function (Category $category) use ($client) {
                $name = CategoryFixture::uniqueCategoryString() . '-concurrent';

                $request = RequestBuilder::of()->categories()->update($category)
                    ->addAction(
                        CategoryChangeNameAction::ofName(
                            LocalizedString::ofLangAndText('en', $name)
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Category::class, $result);

                $this->expectException(FixtureException::class);
                $this->expectExceptionCode(409);
                $this->expectExceptionMessageMatches("/ConcurrentModification/");

                $newName = CategoryFixture::uniqueCategoryString() . '-concurrent';
                $request = RequestBuilder::of()->categories()->update($category)
                    ->addAction(
                        CategoryChangeNameAction::ofName(
                            LocalizedString::ofLangAndText('en', $newName)
                        )
                    );
                $this->execute($client, $request);

                return $result;
            }
        );
    }

    public function testResourceNotFoundByGet()
    {
        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(404);
        $this->expectExceptionMessageMatches("/ResourceNotFound/");

        $client = $this->getApiClient();
        $t = '00000000-0000-0000-0000-000000000000';

        $request = RequestBuilder::of()->products()->getById($t);
        $this->execute($client, $request);
    }

    public function testResourceNotFoundByPost()
    {
        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(404);
        $this->expectExceptionMessageMatches("/ResourceNotFound/");

        $client = $this->getApiClient();
        $t = '00000000-0000-0000-0000-000000000000';

        $request = ProductUpdateRequest::ofIdAndVersion($t, 1);
        $this->execute($client, $request);
    }

    public function testResourceNotFoundByGetInvalidUUID()
    {
        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(404);

        $client = $this->getApiClient();
        $t = '00000000';

        $request = RequestBuilder::of()->products()->getById($t);
        $this->execute($client, $request);
    }

    public function testResourceNotFoundByPostInvalidUUID()
    {
        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(404);

        $client = $this->getApiClient();
        $t = '00000000';

        $request = ProductUpdateRequest::ofIdAndVersion($t, 1);
        $this->execute($client, $request);
    }

    public function testInvalidCredentials()
    {
        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(400);
        $this->expectExceptionMessageMatches("/InvalidCredentials/");
        $client = $this->getApiClient();

        CustomerFixture::withCustomer(
            $client,
            function (Customer $customer) use ($client) {
                $invalidPassword = 'invalidPassword';

                $request = RequestBuilder::of()->customers()->login($customer->getEmail(), $invalidPassword);
                $this->execute($client, $request);
            }
        );
    }

    public function testInvalidCurrentPassword()
    {
        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(400);
        $this->expectExceptionMessageMatches("/InvalidCurrentPassword/");
        $client = $this->getApiClient();

        CustomerFixture::withCustomer(
            $client,
            function (Customer $customer) use ($client) {
                $invalidPassword = 'invalidPassword';
                $newPassword = 'newPassword';

                $request = RequestBuilder::of()->customers()->changePassword($customer, $invalidPassword, $newPassword);
                $this->execute($client, $request);
            }
        );
    }

    public function testDuplicatePriceScope()
    {
        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(400);
        $this->expectExceptionMessageMatches("/DuplicatePriceScope/");

        $client = $this->getApiClient();

        ProductFixture::withDraftProduct(
            $client,
            function (ProductDraft $draft) {
                return $draft->setPublish(true)->setMasterVariant(
                    ProductVariantDraft::ofSkuAndPrices(
                        'test-' . ProductFixture::uniqueProductString() . '-sku',
                        PriceDraftCollection::of()->add(
                            PriceDraft::ofMoneyAndCountry(
                                Money::ofCurrencyAndAmount('EUR', 100),
                                'DE'
                            )
                        )
                    )
                );
            },
            function (Product $product) use ($client) {
                $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
                    ->addAction(
                        ProductAddPriceAction::ofVariantIdAndPrice(
                            1,
                            PriceDraft::ofMoneyAndCountry(
                                Money::ofCurrencyAndAmount('EUR', 200),
                                'DE'
                            )
                        )
                    );
                $this->execute($client, $request);
            }
        );
    }

    public function testDuplicateField()
    {
        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(400);
        $this->expectExceptionMessageMatches("/DuplicateField/");

        $client = $this->getApiClient();

        ProductFixture::withPublishedProduct(
            $client,
            function (Product $product) use ($client) {
                $sku = $product->getMasterData()->getCurrent()->getMasterVariant()->getSku();

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductAddVariantAction::of()
                            ->setSku($sku)
                    );
                $this->execute($client, $request);
            }
        );
    }

    public function testDuplicateVariantValues()
    {
        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(400);
        $this->expectExceptionMessageMatches("/DuplicateVariantValues/");

        $client = $this->getApiClient();

        ProductFixture::withPublishedProduct(
            $client,
            function (Product $product) use ($client) {
                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductAddVariantAction::of()
                            ->setAttributes(
                                AttributeCollection::of()->add(
                                    Attribute::of()->setName('testField')->setValue('123456')
                                )
                            )
                    )
                    ->addAction(
                        ProductAddVariantAction::of()
                            ->setAttributes(
                                AttributeCollection::of()->add(
                                    Attribute::of()->setName('testField')->setValue('123456')
                                )
                            )
                    );
                $this->execute($client, $request);
            }
        );
    }

    public function testDuplicateVariantValuesWithPrice()
    {
        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(400);
        $this->expectExceptionMessageMatches("/DuplicateVariantValues/");

        $client = $this->getApiClient();

        ProductFixture::withPublishedProduct(
            $client,
            function (Product $product) use ($client) {
                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductAddVariantAction::of()
                            ->setPrices(
                                PriceDraftCollection::of()->add(
                                    PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 100))
                                )
                            )
                            ->setAttributes(
                                AttributeCollection::of()->add(
                                    Attribute::of()->setName('testField')->setValue('123456')
                                )
                            )
                    )
                    ->addAction(
                        ProductAddVariantAction::of()
                            ->setPrices(
                                PriceDraftCollection::of()->add(
                                    PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 100))
                                )
                            )
                            ->setAttributes(
                                AttributeCollection::of()->add(
                                    Attribute::of()->setName('testField')->setValue('123456')
                                )
                            )
                    );
                $this->execute($client, $request);
            }
        );
    }

    public function testDuplicateAttributeValue()
    {
        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(400);
        $this->expectExceptionMessageMatches("/InvalidJsonInput/");

        $client = $this->getApiClient();

        ProductFixture::withPublishedProduct(
            $client,
            function (Product $product, ProductType $productType) use ($client) {
                        $request = RequestBuilder::of()->productTypes()->update($productType)
                            ->addAction(
                                ProductTypeAddAttributeDefinitionAction::ofAttribute(
                                    AttributeDefinition::of()
                                        ->setType(StringType::of())
                                        ->setName('uniqueField')
                                        ->setLabel(LocalizedString::ofLangAndText('en', 'uniqueField'))
                                        ->setIsRequired(false)
                                        ->setAttributeConstraint('Unique')
                                )
                            );
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $request = RequestBuilder::of()->products()->update($product)
                            ->addAction(
                                ProductTypeAddAttributeDefinitionAction::ofAttribute(
                                    AttributeDefinition::of()
                                        ->setType(StringType::of())
                                        ->setName('uniqueField')
                                        ->setLabel(LocalizedString::ofLangAndText('en', 'uniqueField'))
                                        ->setIsRequired(false)
                                        ->setAttributeConstraint('Unique')
                                )
                            )
                            ->addAction(
                                ProductAddVariantAction::of()
                                    ->setSku(ProductFixture::uniqueProductString() . '-2')
                                    ->setAttributes(
                                        AttributeCollection::of()->add(
                                            Attribute::of()->setName('uniqueField')->setValue('123456')
                                        )
                                    )
                            );
                        $this->execute($client, $request);

                        return $result;
            }
        );
    }

    public function testDuplicateAttributeValues()
    {
        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(400);
        $this->expectExceptionMessageMatches("/AttributeNameDoesNotExist/");

        $client = $this->getApiClient();

        ProductTypeFixture::withProductType(
            $client,
            function (ProductType $productType) use ($client) {
                $request = RequestBuilder::of()->productTypes()->update($productType)
                    ->addAction(
                        ProductTypeAddAttributeDefinitionAction::ofAttribute(
                            AttributeDefinition::of()
                                ->setType(StringType::of())
                                ->setName('combineField1')
                                ->setLabel(LocalizedString::ofLangAndText('en', 'combineField1'))
                                ->setIsRequired(false)
                                ->setAttributeConstraint('CombinationUnique')
                        )
                    )
                    ->addAction(
                        ProductTypeAddAttributeDefinitionAction::ofAttribute(
                            AttributeDefinition::of()
                                ->setType(StringType::of())
                                ->setName('combineField2')
                                ->setLabel(LocalizedString::ofLangAndText('en', 'combineField2'))
                                ->setIsRequired(false)
                                ->setAttributeConstraint('CombinationUnique')
                        )
                    );
                $response = $this->execute($client, $request);
                $result  = $request->mapFromResponse($response);

                return $result;
            }
        );

        ProductFixture::withPublishedProduct(
            $client,
            function (Product $product) use ($client) {
                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductAddVariantAction::of()
                            ->setSku(ProductFixture::uniqueProductString() . '-1')
                            ->setAttributes(
                                AttributeCollection::of()->add(
                                    Attribute::of()->setName('combineField1')->setValue('abcdef')
                                )->add(
                                    Attribute::of()->setName('combineField2')->setValue('123456')
                                )
                            )
                    )
                    ->addAction(
                        ProductAddVariantAction::of()
                            ->setSku(ProductFixture::uniqueProductString() . '-2')
                            ->setAttributes(
                                AttributeCollection::of()->add(
                                    Attribute::of()->setName('combineField1')->setValue('abcdef')
                                )->add(
                                    Attribute::of()->setName('combineField2')->setValue('123456')
                                )
                            )
                    );
                $this->execute($client, $request);
            }
        );
    }

    public function testRequiredField()
    {
        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(400);
        $this->expectExceptionMessageMatches("/RequiredField/");

        $client = $this->getApiClient();

        ProductFixture::withPublishedProduct(
            $client,
            function (Product $product, ProductType $productType) use ($client) {
                $request = RequestBuilder::of()->productTypes()->update($productType)
                    ->addAction(
                        ProductTypeAddAttributeDefinitionAction::ofAttribute(
                            AttributeDefinition::of()
                                ->setType(StringType::of())
                                ->setName('requiredField')
                                ->setLabel(LocalizedString::ofLangAndText('en', 'requiredField'))
                                ->setIsRequired(true)
                        )
                    );
                $response = $this->execute($client, $request);
                $result  = $request->mapFromResponse($response);

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductAddVariantAction::of()
                            ->setSku($this->getTestRun() . '-1')
                            ->setAttributes(
                                AttributeCollection::of()->add(
                                    Attribute::of()->setName('testField')->setValue('123456')
                                )
                            )
                    );
                $this->execute($client, $request);
            }
        );
    }

    public function testInvalidOperation()
    {
        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(400);
        $this->expectExceptionMessageRegExp("/InvalidOperation/");

        $client = $this->getApiClient();

        CartFixture::withUpdateableCart(
            $client,
            function (Cart $cart) use ($client) {
                $request = RequestBuilder::of()->carts()->update($cart)
                    ->addAction(
                        CartAddLineItemAction::of()
                    );
                $response = $this->execute($client, $request);
                $result  = $request->mapFromResponse($response);

                return $result;
            }
        );
    }

    public function testInvalidField()
    {
        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(400);
        $this->expectExceptionMessageMatches("/InvalidField/");

        $client = $this->getApiClient();

        ProductFixture::withPublishedProduct(
            $client,
            function (Product $product, ProductType $productType) use ($client) {
                $request = RequestBuilder::of()->productTypes()->update($productType)
                    ->addAction(
                        ProductTypeAddAttributeDefinitionAction::ofAttribute(
                            AttributeDefinition::of()
                                ->setType(
                                    EnumType::of()->setValues(
                                        EnumCollection::of()->add(
                                            Enum::of()->setKey('test')->setLabel('test')
                                        )
                                    )
                                )
                                ->setName('enumField')
                                ->setLabel(LocalizedString::ofLangAndText('en', 'enumField'))
                                ->setIsRequired(false)
                        )
                    );
                $response = $this->execute($client, $request);
                $result  = $request->mapFromResponse($response);

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductAddVariantAction::of()
                            ->setSku($this->getTestRun() . '-1')
                            ->setAttributes(
                                AttributeCollection::of()->add(
                                    Attribute::of()->setName('enumField')->setValue('unknown')
                                )
                            )
                    );
                $this->execute($client, $request);

                return $result;
            }
        );
    }

    public function testInsufficientScope()
    {
        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(403);

        $client = $this->getApiClient('view_products');

        ProductFixture::withPublishedProduct(
            $client,
            function (Product $product) use ($client) {
            }
        );
    }

    public function testInvalidToken()
    {
        $cacheAdapter = new ArrayCachePool();

        $config = $this->getClientConfig('manage_project');

        $client = Client::ofConfigCacheAndLogger($config, $cacheAdapter, $this->getLogger());
        $client->getOauthManager()->getHttpClient(['verify' => $this->getVerifySSL()]);
        $client->getHttpClient(['verify' => $this->getVerifySSL()]);

        $cacheScope = $client->getConfig()->getScope() . '-' . $client->getConfig()->getGrantType();
        $cacheKey = Manager::TOKEN_CACHE_KEY . '_' . sha1($cacheScope);

        $cacheItem = $cacheAdapter->getItem($cacheKey);
        $cacheItem->set('1234');
        $cacheAdapter->save($cacheItem);

        $request = RequestBuilder::of()->products()->query();
        $client->addBatchRequest($request);

        $responses = $client->executeBatch();
        $response = current($responses);
        $this->assertTrue($response->isError());
        $this->assertInstanceOf(ErrorResponse::class, $response);
        $this->assertSame(401, $response->getStatusCode());

        $error = $response->getErrors()->current();
        $this->assertInstanceOf(
            InvalidTokenError::class,
            $error
        );
        $this->assertSame(InvalidTokenError::CODE, $error->getCode());
    }

    public function testAccessDenied()
    {
        $request = RequestBuilder::of()->products()->query();
        $httpRequest = $request->httpRequest();

        $config = $this->getClientConfig('manage_project');
        $factory = new Client\Adapter\AdapterFactory();
        $httpClient =  $factory->getAdapter(
            $config->getAdapter(),
            ['base_uri' => $config->getApiUrl() . '/' . $config->getProject(), 'verify' => $this->getVerifySSL()]
        );

        try {
            $httpResponse = $httpClient->execute($httpRequest);
        } catch (ApiException $exception) {
            $httpResponse = $exception->getResponse();
            $response = new ErrorResponse($exception, $request, $httpResponse);
        }
        $this->assertTrue($response->isError());
        $this->assertInstanceOf(ErrorResponse::class, $response);
        $this->assertSame(401, $response->getStatusCode());

        $error = $response->getErrors()->current();
        $this->assertInstanceOf(
            AccessDeniedError::class,
            $error
        );
        $this->assertSame(AccessDeniedError::CODE, $error->getCode());
    }

    public function testEmptyPost()
    {
        $psrRequest = new Request('POST', '/');

        $request = PsrRequest::ofRequest($psrRequest);
        $client = $this->getClient();
        $response = $client->execute($request);

        /**
         * @var ErrorResponse $response
         */
        $this->assertInstanceOf(ErrorResponse::class, $response);
        $this->assertSame(405, $response->getStatusCode());
        $this->assertInstanceOf(ErrorContainer::class, $response->getErrors());
        $this->assertEmpty($response->getErrors());
        $this->assertSame('Method Not Allowed', $response->getMessage());
    }
}
