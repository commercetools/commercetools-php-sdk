<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\IntegrationTests\ShoppingList;

use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\ShoppingList\ShoppingList;
use Commercetools\Core\Model\ShoppingList\ShoppingListDraft;
use Commercetools\Core\Request\ShoppingLists\ShoppingListByIdGetRequest;
use Commercetools\Core\Request\ShoppingLists\ShoppingListByKeyGetRequest;
use Commercetools\Core\Request\ShoppingLists\ShoppingListCreateRequest;
use Commercetools\Core\Request\ShoppingLists\ShoppingListDeleteRequest;
use Commercetools\Core\Request\ShoppingLists\ShoppingListQueryRequest;

class ShoppingListQueryRequestTest extends ApiTestCase
{
    /**
     * @return ShoppingListDraft
     */
    protected function getDraft()
    {
        $draft = ShoppingListDraft::ofNameAndKey(
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-name'),
            'key-' . $this->getTestRun()
        );

        return $draft;
    }

    protected function createShoppingList(ShoppingListDraft $draft)
    {
        /**
         * @var ShoppingList $shoppingList
         */
        $request = ShoppingListCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());

        $shoppingList = $request->mapResponse($response);

        $this->cleanupRequests[] = $this->deleteRequest = ShoppingListDeleteRequest::ofIdAndVersion(
            $shoppingList->getId(),
            $shoppingList->getVersion()
        );

        return $shoppingList;
    }

    public function testQuery()
    {
        $draft = $this->getDraft();
        $shoppingList = $this->createShoppingList($draft);

        $request = ShoppingListQueryRequest::of()->where('key="' . $draft->getKey() . '"');
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertCount(1, $result);
        $this->assertInstanceOf(ShoppingList::class, $result->current());
        $this->assertSame($shoppingList->getId(), $result->current()->getId());
    }

    public function testGetById()
    {
        $draft = $this->getDraft();
        $shoppingList = $this->createShoppingList($draft);

        $request = ShoppingListByIdGetRequest::ofId($shoppingList->getId());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(ShoppingList::class, $shoppingList);
        $this->assertSame($shoppingList->getId(), $result->getId());
    }

    public function testGetByKey()
    {
        $draft = $this->getDraft();
        $shoppingList = $this->createShoppingList($draft);

        $request = ShoppingListByKeyGetRequest::ofKey($shoppingList->getKey());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(ShoppingList::class, $shoppingList);
        $this->assertSame($shoppingList->getId(), $result->getId());
    }
}
