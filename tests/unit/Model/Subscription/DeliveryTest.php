<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Model\Subscription;


use Commercetools\Core\Model\Message\Message;
use Commercetools\Core\Model\Message\ProductCreatedMessage;

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
}
