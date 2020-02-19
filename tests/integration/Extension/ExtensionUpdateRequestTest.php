<?php
/**
 */

namespace Commercetools\Core\IntegrationTests\Extension;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Extension\Extension;
use Commercetools\Core\Model\Extension\ExtensionDraft;
use Commercetools\Core\Model\Extension\HttpDestination;
use Commercetools\Core\Model\Extension\Trigger;
use Commercetools\Core\Model\Extension\TriggerCollection;
use Commercetools\Core\Request\Extensions\Command\ExtensionChangeDestinationAction;
use Commercetools\Core\Request\Extensions\Command\ExtensionChangeTriggersAction;
use Commercetools\Core\Request\Extensions\Command\ExtensionSetKeyAction;
use Commercetools\Core\Request\Extensions\Command\ExtensionSetTimeoutInMsAction;

class ExtensionUpdateRequestTest extends ApiTestCase
{
    public function testSetKey()
    {
        $client = $this->getApiClient();

        ExtensionFixture::withUpdateableExtension(
            $client,
            function (Extension $extension) use ($client) {
                $key = 'new-key-' . ExtensionFixture::uniqueExtensionString();

                $request = RequestBuilder::of()->extensions()->update($extension)
                    ->addAction(
                        ExtensionSetKeyAction::of()->setKey($key)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertNotSame($extension->getVersion(), $result->getVersion());
                $this->assertInstanceOf(Extension::class, $result);
                $this->assertSame($key, $result->getKey());

                return $result;
            }
        );
    }

    public function testUpdateByKey()
    {
        $client = $this->getApiClient();

        ExtensionFixture::withUpdateableExtension(
            $client,
            function (Extension $extension) use ($client) {
                $key = 'new-key-' . ExtensionFixture::uniqueExtensionString();

                $request = RequestBuilder::of()->extensions()->updateByKey($extension)
                    ->addAction(
                        ExtensionSetKeyAction::of()->setKey($key)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertNotSame($extension->getVersion(), $result->getVersion());
                $this->assertInstanceOf(Extension::class, $result);
                $this->assertSame($key, $result->getKey());

                return $result;
            }
        );
    }

    public function testChangeTriggers()
    {
        $client = $this->getApiClient();

        ExtensionFixture::withUpdateableExtension(
            $client,
            function (Extension $extension) use ($client) {
                $request = RequestBuilder::of()->extensions()->update($extension)
                    ->addAction(
                        ExtensionChangeTriggersAction::of()->setTriggers(
                            TriggerCollection::of()->add(
                                Trigger::of()->setResourceTypeId(Trigger::TYPE_ORDER)
                                    ->setActions([Trigger::ACTION_CREATE])
                            )
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertNotSame($extension->getVersion(), $result->getVersion());
                $this->assertInstanceOf(Extension::class, $result);
                $this->assertSame(Trigger::TYPE_ORDER, $result->getTriggers()->current()->getResourceTypeId());

                return $result;
            }
        );
    }

    public function testChangeDestination()
    {
        $client = $this->getApiClient();

        ExtensionFixture::withUpdateableExtension(
            $client,
            function (Extension $extension) use ($client) {
                $request = RequestBuilder::of()->extensions()->update($extension)
                    ->addAction(
                        ExtensionChangeDestinationAction::of()->setDestination(
                            HttpDestination::of()->setUrl('https://api.commercetools.com')
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertNotSame($extension->getVersion(), $result->getVersion());
                $this->assertInstanceOf(Extension::class, $result);
                $this->assertSame('https://api.commercetools.com', $result->getDestination()->getUrl());

                return $result;
            }
        );
    }

    public function testSetTimeoutInMs()
    {
        $client = $this->getApiClient();

        ExtensionFixture::withUpdateableExtension(
            $client,
            function (Extension $extension) use ($client) {
                $this->assertNull($extension->getTimeoutInMs());

                $request = RequestBuilder::of()->extensions()->update($extension)
                    ->addAction(
                        ExtensionSetTimeoutInMsAction::of()->setTimeoutInMs(1000)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertNotSame($extension->getVersion(), $result->getVersion());
                $this->assertInstanceOf(Extension::class, $result);
                $this->assertSame(1000, $result->getTimeoutInMs());

                return $result;
            }
        );
    }

    public function testCreateWithTimeoutMs()
    {
        $client = $this->getApiClient();

        ExtensionFixture::withUpdateableDraftExtension(
            $client,
            function (ExtensionDraft $draft) {
                return $draft->setTimeoutInMs(600);
            },
            function (Extension $extension) use ($client) {
                $this->assertSame(600, $extension->getTimeoutInMs());
            }
        );
    }
}
