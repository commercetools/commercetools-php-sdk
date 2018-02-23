<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Helper\Subscriber;

use Commercetools\Core\Client\OAuth\TokenProvider;
use GuzzleHttp\Event\BeforeEvent;
use GuzzleHttp\Event\RequestEvents;
use GuzzleHttp\Event\SubscriberInterface;

class TokenSubscriber implements SubscriberInterface
{
    /**
     * @var TokenProvider
     */
    private $provider;

    public function __construct(TokenProvider $provider)
    {
        $this->provider = $provider;
    }

    public function getEvents()
    {
        return ['before' => ['onBefore', RequestEvents::PREPARE_REQUEST - 15]];
    }

    public function onBefore(BeforeEvent $event, $name)
    {
        $event->getRequest()->addHeader('Authorization', 'Bearer ' . $this->provider->getToken()->getToken());
    }
}
