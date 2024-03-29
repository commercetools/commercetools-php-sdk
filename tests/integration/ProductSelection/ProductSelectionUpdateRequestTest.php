<?php

namespace Commercetools\Core\IntegrationTests\ProductSelection;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\IntegrationTests\Product\ProductFixture;
use Commercetools\Core\IntegrationTests\Type\TypeFixture;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Message\ProductSelectionCreatedMessage;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Model\Product\ProductReference;
use Commercetools\Core\Model\ProductSelection\AssignedProductReference;
use Commercetools\Core\Model\ProductSelection\ProductSelection;
use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Model\Type\TypeDraft;
use Commercetools\Core\Request\Messages\MessageQueryRequest;
use Commercetools\Core\Request\ProductSelections\Command\ProductSelectionAddProductAction;
use Commercetools\Core\Request\ProductSelections\Command\ProductSelectionChangeNameAction;
use Commercetools\Core\Request\ProductSelections\Command\ProductSelectionRemoveProductAction;
use Commercetools\Core\Request\ProductSelections\Command\ProductSelectionSetCustomFieldAction;
use Commercetools\Core\Request\ProductSelections\Command\ProductSelectionSetCustomTypeAction;
use Commercetools\Core\Request\ProductSelections\Command\ProductSelectionSetKeyAction;
use Commercetools\Core\Request\ProductSelections\ProductSelectionByIdProductsGetRequest;

class ProductSelectionUpdateRequestTest extends ApiTestCase
{
    public function testCreateProductSelection()
    {
        $client = $this->getApiClient();

        ProductSelectionFixture::withProductSelection(
            $client,
            function (ProductSelection $productSelection) use ($client) {
                $this->assertNotEmpty($productSelection);
                $retries = 0;
                do {
                    $retries++;
                    sleep(1);
                    $request = MessageQueryRequest::of()
                        ->where('type = "ProductSelectionCreated"')
                        ->where('resource(id = "' . $productSelection->getId() . '")');
                    $response = $this->execute($client, $request);
                    $result = $request->mapFromResponse($response);
                } while (is_null($result) && $retries <= 9);

                /**
                 * @var ProductSelectionCreatedMessage $message
                 */
                $message = $result->current();

                $this->assertInstanceOf(ProductSelectionCreatedMessage::class, $message);
                $this->assertSame($productSelection->getId(), $message->getResource()->getId());
            }
        );
    }

    public function testChangeName()
    {
        $client = $this->getApiClient();

        ProductSelectionFixture::withUpdateableProductSelection(
            $client,
            function (ProductSelection $product) use ($client) {
                $name = 'new name-' . ProductSelectionFixture::uniqueProductSelectionString();

                $request = RequestBuilder::of()->productSelections()->update($product)
                    ->addAction(
                        ProductSelectionChangeNameAction::ofName(
                            LocalizedString::ofLangAndText('en', $name)
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductSelection::class, $result);
                $this->assertNotSame($product->getName(), $result->getName()->en);
                $this->assertSame($name, $result->getName()->en);

                return $result;
            }
        );
    }

    public function testSetKey()
    {
        $client = $this->getApiClient();

        ProductSelectionFixture::withUpdateableProductSelection(
            $client,
            function (ProductSelection $product) use ($client) {
                $key = 'new-key-' . ProductSelectionFixture::uniqueProductSelectionString();

                $request = RequestBuilder::of()->productSelections()->update($product)
                    ->addAction(
                        ProductSelectionSetKeyAction::ofKey($key)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductSelection::class, $result);
                $this->assertNotSame($product->getKey(), $result->getKey());
                $this->assertSame($key, $result->getKey());

                return $result;
            }
        );
    }

    public function testAddAndRemoveProduct()
    {
        $client = $this->getApiClient();

        ProductFixture::withProduct(
            $client,
            function (Product $product) use ($client) {
                ProductSelectionFixture::withUpdateableProductSelection(
                    $client,
                    function (ProductSelection $productSelection) use ($client, $product) {
                        $productReference = ProductReference::ofId($product->getId());

                        $request = RequestBuilder::of()->productSelections()->update($productSelection)
                            ->addAction(
                                ProductSelectionAddProductAction::ofProduct($productReference)
                            );
                        $response = $this->execute($client, $request);
                        $productSelectionResult = $request->mapFromResponse($response);

                        $this->assertInstanceOf(ProductSelection::class, $productSelectionResult);

                        $request = RequestBuilder::of()->productSelections()->update($productSelectionResult)
                            ->addAction(
                                ProductSelectionRemoveProductAction::ofProduct($productReference)
                            );
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(ProductSelection::class, $result);

                        return $result;
                    }
                );
            }
        );
    }

    public function testQueryProductFromProductSelection()
    {
        $client = $this->getApiClient();

        ProductFixture::withProduct(
            $client,
            function (Product $product) use ($client) {
                ProductSelectionFixture::withUpdateableProductSelection(
                    $client,
                    function (ProductSelection $productSelection) use ($client, $product) {
                        $productReference = ProductReference::ofId($product->getId());

                        $request = RequestBuilder::of()->productSelections()->update($productSelection)
                            ->addAction(
                                ProductSelectionAddProductAction::ofProduct($productReference)
                            );
                        $response = $this->execute($client, $request);
                        $productSelectionResult = $request->mapFromResponse($response);

                        $this->assertInstanceOf(ProductSelection::class, $productSelectionResult);

                        $request = ProductSelectionByIdProductsGetRequest::ofId($productSelection->getId());
                        $response = $this->execute($client, $request);
                        $productSelectionQueryResult = $request->mapFromResponse($response);

                        $this->assertInstanceOf(AssignedProductReference::class, $productSelectionQueryResult);
                        $this->assertSame($product->getId(), current($productSelectionQueryResult)[0]['product']['id']);

                        $request = RequestBuilder::of()->productSelections()->update($productSelectionResult)
                            ->addAction(
                                ProductSelectionRemoveProductAction::ofProduct($productReference)
                            );
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(ProductSelection::class, $result);

                        return $result;
                    }
                );
            }
        );
    }

    public function testCustomField()
    {
        $client = $this->getApiClient();

        TypeFixture::withDraftType(
            $client,
            function (TypeDraft $typeDraft) {
                return $typeDraft->setKey('key-' . TypeFixture::uniqueTypeString())
                    ->setResourceTypeIds(['product-selection']);
            },
            function (Type $type) use ($client) {
                ProductSelectionFixture::withUpdateableProductSelection(
                    $client,
                    function (ProductSelection $productSelection) use ($client, $type) {
                        $request = RequestBuilder::of()->productSelections()->update($productSelection)
                            ->addAction(
                                ProductSelectionSetCustomTypeAction::of()->setType($type->getReference())
                            );
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $productSelection = $result;
                        $value = 'value-' . ProductSelectionFixture::uniqueProductSelectionString();

                        $request = RequestBuilder::of()->productSelections()->update($productSelection)
                            ->addAction(
                                ProductSelectionSetCustomFieldAction::ofName('testField')->setValue($value)
                            );
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(ProductSelection::class, $result);
                        $this->assertSame($value, $result->getCustom()->getFields()->getTestField());
                        $this->assertNotSame($productSelection->getVersion(), $result->getVersion());

                        return $result;
                    }
                );
            }
        );
    }
}
