<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\Subscription;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Subscription\ChangeSubscription;
use Commercetools\Core\Model\Subscription\ChangeSubscriptionCollection;
use Commercetools\Core\Model\Subscription\MessageSubscription;
use Commercetools\Core\Model\Subscription\MessageSubscriptionCollection;
use Commercetools\Core\Model\Subscription\Subscription;
use Commercetools\Core\Request\Subscriptions\Command\SubscriptionSetChangesAction;
use Commercetools\Core\Request\Subscriptions\Command\SubscriptionSetKeyAction;
use Commercetools\Core\Request\Subscriptions\Command\SubscriptionSetMessagesAction;

class SubscriptionUpdateRequestTest extends ApiTestCase
{
    public function setUp(): void
    {
        $uri = getenv('IRONMQ_URI');
        if (empty($uri)) {
            $this->markTestSkipped('Message Queue URL not configured');
        }
    }

    public function testUpdateByKey()
    {
        $client = $this->getApiClient();

        SubscriptionFixture::withUpdateableSubscription(
            $client,
            function (Subscription $subscription) use ($client) {
                $request = RequestBuilder::of()->subscriptions()->updateByKey($subscription);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Subscription::class, $result);
                $this->assertSame($subscription->getId(), $result->getId());
                $this->assertNotSame($subscription->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testUpdateById()
    {
        $client = $this->getApiClient();

        SubscriptionFixture::withUpdateableSubscription(
            $client,
            function (Subscription $subscription) use ($client) {
                $request = RequestBuilder::of()->subscriptions()->update($subscription);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Subscription::class, $result);
                $this->assertSame($subscription->getId(), $result->getId());
                $this->assertNotSame($subscription->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testUpdateKey()
    {
        $client = $this->getApiClient();

        SubscriptionFixture::withUpdateableSubscription(
            $client,
            function (Subscription $subscription) use ($client) {
                $request = RequestBuilder::of()->subscriptions()->update($subscription);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $key = $this->getTestRun() . '-new';

                $request = RequestBuilder::of()->subscriptions()->update($subscription)
                    ->addAction(SubscriptionSetKeyAction::of()->setKey($key));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Subscription::class, $result);
                $this->assertSame($key, $result->getKey());

                return $result;
            }
        );
    }

    public function testUpdateMessages()
    {
        $client = $this->getApiClient();

        SubscriptionFixture::withUpdateableSubscription(
            $client,
            function (Subscription $subscription) use ($client) {
                $request = RequestBuilder::of()->subscriptions()->update($subscription)
                    ->addAction(
                        SubscriptionSetMessagesAction::of()->setMessages(
                            MessageSubscriptionCollection::of()->add(
                                MessageSubscription::of()->setResourceTypeId('order')
                            )
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Subscription::class, $result);
                $this->assertCount(1, $result->getMessages());
                $this->assertSame('order', $result->getMessages()->current()->getResourceTypeId());

                return $result;
            }
        );
    }

    public function testUpdateChanges()
    {
        $client = $this->getApiClient();

        SubscriptionFixture::withUpdateableSubscription(
            $client,
            function (Subscription $subscription) use ($client) {
                $request = RequestBuilder::of()->subscriptions()->update($subscription)
                    ->addAction(
                        SubscriptionSetChangesAction::of()->setChanges(
                            ChangeSubscriptionCollection::of()->add(
                                ChangeSubscription::of()->setResourceTypeId('product')
                            )
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Subscription::class, $result);
                $this->assertCount(1, $result->getMessages());
                $this->assertSame('product', $result->getChanges()->current()->getResourceTypeId());

                return $result;
            }
        );
    }
}
