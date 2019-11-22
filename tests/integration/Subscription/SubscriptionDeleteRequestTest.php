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

    /**
     * @return SubscriptionDraft
     */
    protected function getDraft()
    {
        $uri = getenv('IRONMQ_URI');
        $destination = IronMQDestination::ofUri($uri);
        $messages = MessageSubscriptionCollection::of()->add(MessageSubscription::of()->setResourceTypeId('product'));
        $key = 'test-' . $this->getTestRun();
        $draft = SubscriptionDraft::ofKeyDestinationAndMessages($key, $destination, $messages);

        return $draft;
    }

    protected function createSubscription(SubscriptionDraft $draft)
    {
        $request = SubscriptionCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $subscription = $request->mapResponse($response);
        $this->cleanupRequests[] = $this->deleteRequest = SubscriptionDeleteRequest::ofIdAndVersion(
            $subscription->getId(),
            $subscription->getVersion()
        );

        return $subscription;
    }

    public function testDeleteById()
    {
        $draft = $this->getDraft();
        $subscription = $this->createSubscription($draft);

        $request = SubscriptionDeleteRequest::ofIdAndVersion(
            $subscription->getId(),
            $subscription->getVersion()
        );
        $response = $request->executeWithClient($this->getClient());
        $this->assertFalse($response->isError());
    }

    public function testDeleteByKey()
    {
        $draft = $this->getDraft();
        $subscription = $this->createSubscription($draft);

        $request = SubscriptionDeleteByKeyRequest::ofKeyAndVersion(
            $subscription->getKey(),
            $subscription->getVersion()
        );
        $response = $request->executeWithClient($this->getClient());
        $this->assertFalse($response->isError());
    }
}
