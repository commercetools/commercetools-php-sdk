<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Subscription;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Subscription\IronMQDestination;
use Commercetools\Core\Model\Subscription\MessageSubscription;
use Commercetools\Core\Model\Subscription\MessageSubscriptionCollection;
use Commercetools\Core\Model\Subscription\SubscriptionDraft;
use Commercetools\Core\Request\Subscriptions\SubscriptionByIdGetRequest;
use Commercetools\Core\Request\Subscriptions\SubscriptionByKeyGetRequest;
use Commercetools\Core\Request\Subscriptions\SubscriptionCreateRequest;
use Commercetools\Core\Request\Subscriptions\SubscriptionDeleteRequest;
use Commercetools\Core\Request\Subscriptions\SubscriptionQueryRequest;
use Commercetools\Core\Request\Subscriptions\SubscriptionUpdateRequest;

class SubscriptionUpdateRequestTest extends ApiTestCase
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
        $this->cleanupRequests[] = SubscriptionDeleteRequest::ofIdAndVersion(
            $subscription->getId(),
            $subscription->getVersion()
        );

        return $subscription;
    }

    public function testUpdateKey()
    {
        $draft = $this->getDraft();
        $subscription = $this->createSubscription($draft);

        $request = SubscriptionUpdateRequest::ofIdAndVersion($subscription->getId(), $subscription->getVersion());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Subscription\Subscription', $result);
    }
}
