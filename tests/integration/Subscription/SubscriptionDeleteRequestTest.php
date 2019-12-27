<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\Subscription;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Subscription\Subscription;

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
