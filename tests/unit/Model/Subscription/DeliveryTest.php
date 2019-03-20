<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Model\Subscription;


use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Message\Message;
use Commercetools\Core\Model\Message\ProductCreatedMessage;
use Commercetools\Core\Model\Message\UserProvidedIdentifiers;

class DeliveryTest extends \PHPUnit\Framework\TestCase
{

    public function testGetGenericMessage()
    {
        $payload = [
            'projectKey' => 'test',
            'notificationType' => 'Message',
            'resource' => [
                'typeId' => 'product',
                'id' => '123465678'
            ],
            'id' => 'abcdef',
            'version' => 1,
            'sequenceNumber' => 1,
            'resourceVersion' => 1,
        ];

        $delivery = Delivery::fromArray($payload);

        $this->assertInstanceOf(MessageDelivery::class, $delivery);
        $this->assertInstanceOf(Message::class, $delivery->getMessage());
    }

    public function testGetSpecificMessage()
    {
        $payload = [
            'projectKey' => 'test',
            'notificationType' => 'Message',
            'resource' => [
                'typeId' => 'product',
                'id' => '123465678'
            ],
            'id' => 'abcdef',
            'version' => 1,
            'sequenceNumber' => 1,
            'resourceVersion' => 1,
            'type' => 'ProductCreated',
            'productProjection' => []
        ];

        $delivery = Delivery::fromArray($payload);

        $this->assertInstanceOf(MessageDelivery::class, $delivery);
        $this->assertInstanceOf(ProductCreatedMessage::class, $delivery->getMessage());
        $this->assertSame('ProductCreated', $delivery->getMessageType());
    }

    public function testPayloadNotIncluded()
    {
        $payload = [
            'projectKey' => 'test',
            'notificationType' => 'Message',
            'resource' => [
                'typeId' => 'product',
                'id' => '123465678'
            ],
            'payloadNotIncluded' => [
                'reason' => 'foo',
                'payloadType' => 'ProductCreated'
            ]
        ];

        $delivery = Delivery::fromArray($payload);

        $this->assertInstanceOf(MessageDelivery::class, $delivery);
        $this->assertSame('ProductCreated', $delivery->getMessageType());
    }

    public function testResourceCreatedPayload()
    {
        $payload = [
            'projectKey' => 'test',
            'notificationType' => 'ResourceCreated',
            'resource' => [
                'typeId' => 'product',
                'id' => '123465678'
            ],
            'version' => 1,
        ];

        $delivery = Delivery::fromArray($payload);

        $this->assertInstanceOf(ResourceCreatedDelivery::class, $delivery);
    }

    public function testResourceUpdatedPayload()
    {
        $payload = [
            'projectKey' => 'test',
            'notificationType' => 'ResourceUpdated',
            'resource' => [
                'typeId' => 'product',
                'id' => '123465678'
            ],
            'oldVersion' => 1,
            'version' => 2,
        ];

        $delivery = Delivery::fromArray($payload);

        $this->assertInstanceOf(ResourceUpdatedDelivery::class, $delivery);
    }

    public function testResourceDeletedPayload()
    {
        $payload = [
            'projectKey' => 'test',
            'notificationType' => 'ResourceDeleted',
            'resource' => [
                'typeId' => 'product',
                'id' => '123465678'
            ],
            'version' => 2,
        ];

        $delivery = Delivery::fromArray($payload);

        $this->assertInstanceOf(ResourceDeletedDelivery::class, $delivery);
    }

    public function testGetGenericMessageWithUserProvidedIdentifiers()
    {
        $payload = [
            'projectKey' => 'test',
            'notificationType' => 'Message',
            'resource' => [
                'typeId' => 'customer',
                'id' => '123465678'
            ],
            'id' => 'abcdef',
            'version' => 1,
            'sequenceNumber' => 1,
            'resourceVersion' => 1,
            'resourceUserProvidedIdentifiers' => [
                'key' => 'user-provided-key',
                'externalId' => 'user-provided-external-id',
                'orderNumber' => 'user-provided-order-number',
                'customerNumber' => 'user-provided-customer-number',
                'sku' => 'user-provided-sku',
                'slug' => [
                    'en' => 'user-provided-slug'
                ]
            ]
        ];

        $delivery = Delivery::fromArray($payload);

        $this->assertInstanceOf(MessageDelivery::class, $delivery);
        $this->assertInstanceOf(Message::class, $delivery->getMessage());
        $this->assertInstanceOf(UserProvidedIdentifiers::class, $delivery->getResourceUserProvidedIdentifiers());

        $userProvidedIdentifiers = $delivery->getResourceUserProvidedIdentifiers();
        $this->assertSame('user-provided-key', $userProvidedIdentifiers->getKey());
        $this->assertSame('user-provided-external-id', $userProvidedIdentifiers->getExternalId());
        $this->assertSame('user-provided-order-number', $userProvidedIdentifiers->getOrderNumber());
        $this->assertSame('user-provided-customer-number', $userProvidedIdentifiers->getCustomerNumber());
        $this->assertSame('user-provided-sku', $userProvidedIdentifiers->getSku());

        $this->assertInstanceOf(LocalizedString::class, $userProvidedIdentifiers->getSlug());
        $slug = $userProvidedIdentifiers->getSlug();
        $context = Context::of();
        $context->setLanguages(['en']);
        $this->assertSame('user-provided-slug', $slug->getLocalized($context));
    }
}
