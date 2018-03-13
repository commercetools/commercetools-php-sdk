<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Subscription;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Subscription\IronMQDestination;
use Commercetools\Core\Model\Subscription\MessageSubscription;
use Commercetools\Core\Model\Subscription\MessageSubscriptionCollection;
use Commercetools\Core\Model\Subscription\Subscription;
use Commercetools\Core\Model\Subscription\SubscriptionDraft;
use Commercetools\Core\Request\Subscriptions\SubscriptionByIdGetRequest;
use Commercetools\Core\Request\Subscriptions\SubscriptionByKeyGetRequest;
use Commercetools\Core\Request\Subscriptions\SubscriptionCreateRequest;
use Commercetools\Core\Request\Subscriptions\SubscriptionDeleteRequest;
use Commercetools\Core\Request\Subscriptions\SubscriptionQueryRequest;

class SubscriptionQueryRequestTest extends ApiTestCase
{
    public function setUp()
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
        $draft = SubscriptionDraft::ofDestinationAndMessages($destination, $messages)
            ->setKey('test-' . $this->getTestRun());

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

    public function testQuery()
    {
        $draft = $this->getDraft();
        $subscription = $this->createSubscription($draft);

        $request = SubscriptionQueryRequest::of()->where('key="' . $draft->getKey() . '"');
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertCount(1, $result);
        $this->assertInstanceOf(Subscription::class, $result->getAt(0));
        $this->assertSame($subscription->getId(), $result->getAt(0)->getId());
    }

    public function testGetById()
    {
        $draft = $this->getDraft();
        $subscription = $this->createSubscription($draft);

        $request = SubscriptionByIdGetRequest::ofId($subscription->getId());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(Subscription::class, $subscription);
        $this->assertSame($subscription->getId(), $result->getId());
    }

    public function testGetByKey()
    {
        $draft = $this->getDraft();
        $subscription = $this->createSubscription($draft);

        $request = SubscriptionByKeyGetRequest::ofKey($subscription->getKey());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(Subscription::class, $subscription);
        $this->assertSame($subscription->getId(), $result->getId());
    }
}
