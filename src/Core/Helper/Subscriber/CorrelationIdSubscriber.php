<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Helper\Subscriber;

use Commercetools\Core\Helper\CorrelationIdProvider;
use Commercetools\Core\Response\AbstractApiResponse;
use GuzzleHttp\Event\BeforeEvent;
use GuzzleHttp\Event\RequestEvents;
use GuzzleHttp\Event\SubscriberInterface;

class CorrelationIdSubscriber implements SubscriberInterface
{
    /**
     * @var CorrelationIdProvider
     */
    private $provider;

    public function __construct(CorrelationIdProvider $provider)
    {
        $this->provider = $provider;
    }

    public function getEvents()
    {
        return ['before' => ['onBefore', RequestEvents::PREPARE_REQUEST - 10]];
    }

    public function onBefore(BeforeEvent $event, $name)
    {
        $event->getRequest()->addHeader(AbstractApiResponse::X_CORRELATION_ID, $this->provider->getCorrelationId());
    }
}
