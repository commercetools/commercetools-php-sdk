<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\ShoppingList;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Common\Enum;
use Commercetools\Core\Model\Common\EnumCollection;
use Commercetools\Core\Model\Common\LocalizedEnum;
use Commercetools\Core\Model\Common\LocalizedEnumCollection;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\ShoppingList\EnumShoppingList;
use Commercetools\Core\Model\ShoppingList\FieldDefinition;
use Commercetools\Core\Model\ShoppingList\FieldDefinitionCollection;
use Commercetools\Core\Model\ShoppingList\LocalizedEnumShoppingList;
use Commercetools\Core\Model\ShoppingList\StringShoppingList;
use Commercetools\Core\Model\ShoppingList\ShoppingList;
use Commercetools\Core\Model\ShoppingList\ShoppingListDraft;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListAddEnumValueAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListAddFieldDefinitionAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListAddLocalizedEnumValueAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListChangeKeyAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListChangeLabelAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListChangeNameAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListRemoveFieldDefinitionAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetDescriptionAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetKeyAction;
use Commercetools\Core\Request\ShoppingLists\ShoppingListCreateRequest;
use Commercetools\Core\Request\ShoppingLists\ShoppingListDeleteRequest;
use Commercetools\Core\Request\ShoppingLists\ShoppingListUpdateByKeyRequest;
use Commercetools\Core\Request\ShoppingLists\ShoppingListUpdateRequest;

class ShoppingListUpdateRequestTest extends ApiTestCase
{
    /**
     * @return ShoppingListDraft
     */
    protected function getDraft($name)
    {
        $draft = ShoppingListDraft::ofNameAndKey(
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-' . $name),
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

    public function testChangeByKey()
    {
        $draft = $this->getDraft('change-by-key');
        $shoppingList = $this->createShoppingList($draft);

        $name = $this->getTestRun() . '-new name';
        $request = ShoppingListUpdateByKeyRequest::ofKeyAndVersion($shoppingList->getKey(), $shoppingList->getVersion())
            ->addAction(ShoppingListChangeNameAction::ofName(LocalizedString::ofLangAndText('en', $name)))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\ShoppingList\ShoppingList', $result);
        $this->assertSame($name, $result->getName()->en);
    }

    public function testSetKey()
    {
        $draft = $this->getDraft('set-key');
        $shoppingList = $this->createShoppingList($draft);

        $key = 'new-' . $this->getTestRun();
        $request = ShoppingListUpdateRequest::ofIdAndVersion($shoppingList->getId(), $shoppingList->getVersion())
            ->addAction(ShoppingListSetKeyAction::ofKey($key))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\ShoppingList\ShoppingList', $result);
        $this->assertSame($key, $result->getKey());
    }

    public function testChangeKeyLength()
    {
        $draft = $this->getDraft('change-key');
        $draft->setKey(str_pad($draft->getKey(), 256, '0'));
        $shoppingList = $this->createShoppingList($draft);

        $key = str_pad('new-' . $this->getTestRun(), 256, '0');
        $request = ShoppingListUpdateRequest::ofIdAndVersion($shoppingList->getId(), $shoppingList->getVersion())
            ->addAction(ShoppingListSetKeyAction::ofKey($key))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\ShoppingList\ShoppingList', $result);
        $this->assertSame($key, $result->getKey());
    }

    public function testChangeName()
    {
        $draft = $this->getDraft('change-name');
        $shoppingList = $this->createShoppingList($draft);

        $name = $this->getTestRun() . '-new name';
        $request = ShoppingListUpdateRequest::ofIdAndVersion($shoppingList->getId(), $shoppingList->getVersion())
            ->addAction(ShoppingListChangeNameAction::ofName(LocalizedString::ofLangAndText('en', $name)))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\ShoppingList\ShoppingList', $result);
        $this->assertSame($name, $result->getName()->en);
    }
}
