<?php
/**
 */

namespace Commercetools\Core\Extension;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Model\Extension\Extension;
use Commercetools\Core\Model\Extension\ExtensionDraft;
use Commercetools\Core\Model\Extension\HttpDestination;
use Commercetools\Core\Model\Extension\Trigger;
use Commercetools\Core\Model\Extension\TriggerCollection;
use Commercetools\Core\Request\Extensions\Command\ExtensionChangeDestinationAction;
use Commercetools\Core\Request\Extensions\Command\ExtensionChangeTriggersAction;
use Commercetools\Core\Request\Extensions\Command\ExtensionSetKeyAction;
use Commercetools\Core\Request\Extensions\ExtensionCreateRequest;
use Commercetools\Core\Request\Extensions\ExtensionDeleteRequest;

class ExtensionUpdateRequestTest extends ApiTestCase
{
    private function getExtensionDraft()
    {
        return ExtensionDraft::ofDestinationAndTriggers(
            HttpDestination::of()->setUrl('https://api.sphere.io'),
            TriggerCollection::of()->add(
                Trigger::of()->setResourceTypeId('cart')->setActions([Trigger::ACTION_CREATE])
            )
        )->setKey('test-' .$this->getTestRun());
    }

    private function createExtension(ExtensionDraft $draft)
    {
        $request = ExtensionCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $extension = $request->mapResponse($response);
        $this->cleanupRequests[] = $this->deleteRequest = ExtensionDeleteRequest::ofIdAndVersion(
            $extension->getId(),
            $extension->getVersion()
        );

        return $extension;
    }

    public function testSetKey()
    {
        $draft = $this->getExtensionDraft();
        $extension = $this->createExtension($draft);

        $key = 'new-key-' . $this->getTestRun();
        $request = RequestBuilder::of()->extensions()->update($extension)
            ->addAction(
                ExtensionSetKeyAction::of()->setKey($key)
            );
        $response = $this->getClient()->execute($request);
        $result = $request->mapFromResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertNotSame($extension->getVersion(), $result->getVersion());
        $this->assertInstanceOf(Extension::class, $result);
        $this->assertSame($key, $result->getKey());
    }

    public function testUpdateByKey()
    {
        $draft = $this->getExtensionDraft();
        $extension = $this->createExtension($draft);

        $key = 'new-key-' . $this->getTestRun();
        $request = RequestBuilder::of()->extensions()->updateByKey($extension)
            ->addAction(
                ExtensionSetKeyAction::of()->setKey($key)
            );
        $response = $this->getClient()->execute($request);
        $result = $request->mapFromResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertNotSame($extension->getVersion(), $result->getVersion());
        $this->assertInstanceOf(Extension::class, $result);
        $this->assertSame($key, $result->getKey());
    }

    public function testChangeTriggers()
    {
        $draft = $this->getExtensionDraft();
        $extension = $this->createExtension($draft);

        $request = RequestBuilder::of()->extensions()->update($extension)
            ->addAction(
                ExtensionChangeTriggersAction::of()->setTriggers(
                    TriggerCollection::of()->add(
                        Trigger::of()->setResourceTypeId(Trigger::TYPE_ORDER)
                            ->setActions([Trigger::ACTION_CREATE])
                    )
                )
            );
        $response = $this->getClient()->execute($request);
        $result = $request->mapFromResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertNotSame($extension->getVersion(), $result->getVersion());
        $this->assertInstanceOf(Extension::class, $result);
        $this->assertSame(Trigger::TYPE_ORDER, $result->getTriggers()->current()->getResourceTypeId());
    }

    public function testChangeDestination()
    {
        $draft = $this->getExtensionDraft();
        $extension = $this->createExtension($draft);

        $request = RequestBuilder::of()->extensions()->update($extension)
            ->addAction(
                ExtensionChangeDestinationAction::of()->setDestination(
                    HttpDestination::of()->setUrl('https://api.commercetools.com')
                )
            );
        $response = $this->getClient()->execute($request);
        $result = $request->mapFromResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertNotSame($extension->getVersion(), $result->getVersion());
        $this->assertInstanceOf(Extension::class, $result);
        $this->assertSame('https://api.commercetools.com', $result->getDestination()->getUrl());
    }
}
