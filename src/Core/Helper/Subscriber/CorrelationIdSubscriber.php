<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Helper\Subscriber;

use Commercetools\Core\Response\AbstractApiResponse;
use GuzzleHttp\Event\BeforeEvent;
use GuzzleHttp\Event\RequestEvents;
use GuzzleHttp\Event\SubscriberInterface;
use Ramsey\Uuid\Uuid;

class CorrelationIdSubscriber implements SubscriberInterface
{
    private $projectKey;

    public function __construct($projectKey = null)
    {
        $projectKey = !is_null($projectKey) ? $projectKey : 'php';
        $this->projectKey = $projectKey;
    }

    public function getEvents()
    {
        return ['before' => ['onBefore', RequestEvents::PREPARE_REQUEST - 10]];
    }

    public function onBefore(BeforeEvent $event, $name)
    {
        $event->getRequest()->addHeader(AbstractApiResponse::X_CORRELATION_ID, $this->getCorrelationId());
    }

    private function getCorrelationId()
    {
        return $this->projectKey . '-' . Uuid::uuid4()->toString();
    }
}
