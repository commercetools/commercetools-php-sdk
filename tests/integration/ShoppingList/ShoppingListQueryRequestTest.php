<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\ShoppingList;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\ShoppingList\ShoppingList;

class ShoppingListQueryRequestTest extends ApiTestCase
{
    public function testQuery()
    {
        $client = $this->getApiClient();

        ShoppingListFixture::withShoppingList(
            $client,
            function (ShoppingList $shoppingList) use ($client) {
                $request = RequestBuilder::of()->shoppingLists()->query()
                    ->where('key=:key', ['key' => $shoppingList->getKey()]);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(1, $result);
                $this->assertInstanceOf(ShoppingList::class, $result->current());
                $this->assertSame($shoppingList->getId(), $result->current()->getId());
            }
        );
    }

    public function testGetById()
    {
        $client = $this->getApiClient();

        ShoppingListFixture::withShoppingList(
            $client,
            function (ShoppingList $shoppingList) use ($client) {
                $request = RequestBuilder::of()->shoppingLists()->getById($shoppingList->getId());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ShoppingList::class, $shoppingList);
                $this->assertSame($shoppingList->getId(), $result->getId());
            }
        );
    }

    public function testGetByKey()
    {
        $client = $this->getApiClient();

        ShoppingListFixture::withShoppingList(
            $client,
            function (ShoppingList $shoppingList) use ($client) {
                $request = RequestBuilder::of()->shoppingLists()->getByKey($shoppingList->getKey());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ShoppingList::class, $shoppingList);
                $this->assertSame($shoppingList->getId(), $result->getId());
                $this->assertSame($shoppingList->getKey(), $result->getKey());
            }
        );
    }
}
