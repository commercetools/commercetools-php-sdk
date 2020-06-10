<?php
/**
 */

namespace Commercetools\Core\IntegrationTests\Me;

use Commercetools\Core\Helper\Uuid;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\ShoppingList\MyShoppingListDraft;
use Commercetools\Core\Model\ShoppingList\ShoppingList;
use Commercetools\Core\Model\ShoppingList\ShoppingListCollection;
use Commercetools\Core\Request\Me\MeShoppingListByIdGetRequest;
use Commercetools\Core\Request\Me\MeShoppingListByKeyGetRequest;
use Commercetools\Core\Request\Me\MeShoppingListCreateRequest;
use Commercetools\Core\Request\Me\MeShoppingListDeleteRequest;
use Commercetools\Core\Request\Me\MeShoppingListQueryRequest;
use Commercetools\Core\Request\Me\MeShoppingListUpdateRequest;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListChangeNameAction;
use Commercetools\Core\Request\ShoppingLists\ShoppingListDeleteRequest;

class MeShoppingListRequestTest extends ApiTestCase
{
    /**
     * @return MyShoppingListDraft
     */
    protected function getMyShoppingListDraft()
    {
        $draft = MyShoppingListDraft::ofName(
            LocalizedString::ofLangAndText('en', 'name-' . $this->getTestRun())
        )->setKey('test-' . Uuid::uuidv4());

        return $draft;
    }

    public function tearDown(): void
    {
        parent::tearDown();
        $this->getCache()->clear();
    }


    public function testCreateShoppingListForAnonymous()
    {
        $request = MeShoppingListCreateRequest::ofDraft($this->getMyShoppingListDraft());
        $response = $this->getAnonymousMeClient()->execute($request);
        $shoppingList = $request->mapFromResponse($response);

        $this->cleanupRequests[] = ShoppingListDeleteRequest::ofIdAndVersion(
            $shoppingList->getId(),
            $shoppingList->getVersion()
        );

        $this->assertInstanceOf(ShoppingList::class, $shoppingList);
    }

    public function testCreateShoppingListForCustomer()
    {
        $request = MeShoppingListCreateRequest::ofDraft($this->getMyShoppingListDraft());
        $response = $this->getCustomerMeClient()->execute($request);
        $shoppingList = $request->mapFromResponse($response);

        $this->cleanupRequests[] = ShoppingListDeleteRequest::ofIdAndVersion(
            $shoppingList->getId(),
            $shoppingList->getVersion()
        );

        $this->assertInstanceOf(ShoppingList::class, $shoppingList);
    }

    public function testGetMyShoppingListById()
    {
        $request = MeShoppingListCreateRequest::ofDraft($this->getMyShoppingListDraft());
        $response = $this->getCustomerMeClient()->execute($request);
        $shoppingList = $request->mapFromResponse($response);

        $this->cleanupRequests[] = ShoppingListDeleteRequest::ofIdAndVersion(
            $shoppingList->getId(),
            $shoppingList->getVersion()
        );

        $this->assertInstanceOf(ShoppingList::class, $shoppingList);

        $getRequest = MeShoppingListByIdGetRequest::ofId($shoppingList->getId());
        $getResponse = $this->getCustomerMeClient()->execute($getRequest);
        $shoppingList = $getRequest->mapFromResponse($getResponse);

        $this->assertInstanceOf(ShoppingList::class, $shoppingList);
    }

    public function testGetMyShoppingListByKey()
    {
        $request = MeShoppingListCreateRequest::ofDraft($this->getMyShoppingListDraft());
        $response = $this->getCustomerMeClient()->execute($request);
        $shoppingList = $request->mapFromResponse($response);

        $this->cleanupRequests[] = ShoppingListDeleteRequest::ofIdAndVersion(
            $shoppingList->getId(),
            $shoppingList->getVersion()
        );

        $this->assertInstanceOf(ShoppingList::class, $shoppingList);

        $getRequest = MeShoppingListByKeyGetRequest::ofKey($shoppingList->getKey());
        $getResponse = $this->getCustomerMeClient()->execute($getRequest);
        $shoppingList = $getRequest->mapFromResponse($getResponse);

        $this->assertInstanceOf(ShoppingList::class, $shoppingList);
    }

    public function testQueryMyShoppingLists()
    {
        $request = MeShoppingListCreateRequest::ofDraft($this->getMyShoppingListDraft());
        $response = $this->getCustomerMeClient()->execute($request);
        $shoppingList = $request->mapFromResponse($response);

        $this->cleanupRequests[] = ShoppingListDeleteRequest::ofIdAndVersion(
            $shoppingList->getId(),
            $shoppingList->getVersion()
        );
        $this->assertInstanceOf(ShoppingList::class, $shoppingList);

        $queryRequest = MeShoppingListQueryRequest::of()->where('name(en="name-' . $this->getTestRun() . '")');
        $queryResponse = $this->getCustomerMeClient()->execute($queryRequest);
        $shoppingListCollection = $queryRequest->mapFromResponse($queryResponse);

        $this->assertInstanceOf(ShoppingListCollection::class, $shoppingListCollection);
        $this->assertInstanceOf(ShoppingList::class, $shoppingListCollection->current());
        $this->assertSame('name-' . $this->getTestRun(), $shoppingList->getName()->en);
    }

    public function testUpdateMyShoppingList()
    {
        $request = MeShoppingListCreateRequest::ofDraft($this->getMyShoppingListDraft());
        $response = $this->getCustomerMeClient()->execute($request);
        $shoppingList = $request->mapFromResponse($response);

        $this->cleanupRequests[] = ShoppingListDeleteRequest::ofIdAndVersion(
            $shoppingList->getId(),
            $shoppingList->getVersion()
        );
        $this->assertInstanceOf(ShoppingList::class, $shoppingList);
        $this->assertSame('name-' . $this->getTestRun(), $shoppingList->getName()->en);

        $updateRequest = MeShoppingListUpdateRequest::ofIdAndVersion($shoppingList->getId(), $shoppingList->getVersion())
            ->addAction(ShoppingListChangeNameAction::ofName(
                LocalizedString::ofLangAndText('en', 'new-name-' . $this->getTestRun())
            ));
        $updateResponse = $this->getCustomerMeClient()->execute($updateRequest);
        $shoppingList = $updateRequest->mapFromResponse($updateResponse);

        $this->assertInstanceOf(ShoppingList::class, $shoppingList);
        $this->assertSame('new-name-' . $this->getTestRun(), $shoppingList->getName()->en);
    }

    public function testDeleteMyShoppingList()
    {
        $request = MeShoppingListCreateRequest::ofDraft($this->getMyShoppingListDraft());
        $response = $this->getCustomerMeClient()->execute($request);
        $shoppingList = $request->mapFromResponse($response);

        $this->assertInstanceOf(ShoppingList::class, $shoppingList);

        $deleteRequest = MeShoppingListDeleteRequest::ofIdAndVersion($shoppingList->getId(), $shoppingList->getVersion());
        $deleteResponse = $this->getCustomerMeClient()->execute($deleteRequest);
        $shoppingList = $deleteRequest->mapFromResponse($deleteResponse);

        $this->assertInstanceOf(ShoppingList::class, $shoppingList);

        $getRequest = MeShoppingListByIdGetRequest::ofId($shoppingList->getId());
        $getResponse = $this->getCustomerMeClient()->execute($getRequest);
        $shoppingList = $getRequest->mapFromResponse($getResponse);

        $this->assertNull($shoppingList);
    }
}
