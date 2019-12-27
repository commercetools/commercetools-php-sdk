<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\Subscription;

use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Subscription\IronMQDestination;
use Commercetools\Core\Model\Subscription\MessageSubscription;
use Commercetools\Core\Model\Subscription\MessageSubscriptionCollection;
use Commercetools\Core\Model\Subscription\SubscriptionDraft;
use Commercetools\Core\Request\Subscriptions\SubscriptionCreateRequest;
use Commercetools\Core\Request\Subscriptions\SubscriptionDeleteByKeyRequest;
use Commercetools\Core\Request\Subscriptions\SubscriptionDeleteRequest;

class SubscriptionDeleteRequestTest extends ApiTestCase
{
    public function setUp(): void
    {
        $uri = getenv('IRONMQ_URI');
        if (empty($uri)) {
            $this->markTestSkipped('Message Queue URL not configured');
        }
    }
    public function testDeleteById()
    {
        $client = $this->getApiClient();
        SubscriptionFixture::withSubscription(
            $client,
            function (Subscription $subscription) use ($client) {
                $request = RequestBuilder::of()->subscriptions()->delete($subscription);
                $response = $client->execute($request);
                $result = $request->mapFromResponse($response);
                $this->assertSame($subscription->getId(), $result->getId());
            }
        );
    }
    public function testDeleteByKey()
    {
        $client = $this->getApiClient();
        SubscriptionFixture::withSubscription(
            $client,
            function (Subscription $subscription) use ($client) {
                $request = RequestBuilder::of()->subscriptions()->deleteByKey($subscription);
                $response = $client->execute($request);
                $result = $request->mapFromResponse($response);
                $this->assertSame($subscription->getId(), $result->getId());
            }
        );
    }
}
