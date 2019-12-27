<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\Subscription;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Subscription\Subscription;

class SubscriptionQueryRequestTest extends ApiTestCase
{
    public function setUp(): void
    {
        $uri = getenv('IRONMQ_URI');
        if (empty($uri)) {
            $this->markTestSkipped('Message Queue URL not configured');
        }
    }
    public function testQuery()
    {
        $client = $this->getApiClient();
        SubscriptionFixture::withSubscription(
            $client,
            function (Subscription $subscription) use ($client) {
                $request = RequestBuilder::of()->subscriptions()->query()
                    ->where('key=:key', ['key' => $subscription->getKey()]);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);
                $this->assertCount(1, $result);
                $this->assertInstanceOf(Subscription::class, $result->current());
                $this->assertSame($subscription->getId(), $result->current()->getId());
            }
        );
    }
    public function testGetById()
    {
        $client = $this->getApiClient();
        SubscriptionFixture::withSubscription(
            $client,
            function (Subscription $subscription) use ($client) {
                $request = RequestBuilder::of()->subscriptions()->getById($subscription->getId());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);
                $this->assertInstanceOf(Subscription::class, $result);
                $this->assertSame($subscription->getId(), $result->getId());
            }
        );
    }
    public function testGetByKey()
    {
        $client = $this->getApiClient();
        SubscriptionFixture::withSubscription(
            $client,
            function (Subscription $subscription) use ($client) {
                $request = RequestBuilder::of()->subscriptions()->getByKey($subscription->getKey());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);
                $this->assertInstanceOf(Subscription::class, $result);
                $this->assertSame($subscription->getId(), $result->getId());
                $this->assertSame($subscription->getKey(), $result->getKey());
            }
        );
    }
}
