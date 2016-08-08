<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Channel;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Channel\ChannelDraft;
use Commercetools\Core\Model\Channel\ChannelRole;
use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Request\Channels\ChannelCreateRequest;
use Commercetools\Core\Request\Channels\ChannelDeleteRequest;
use Commercetools\Core\Request\Channels\ChannelUpdateRequest;
use Commercetools\Core\Request\Channels\Command\ChannelAddRolesAction;
use Commercetools\Core\Request\Channels\Command\ChannelChangeDescriptionAction;
use Commercetools\Core\Request\Channels\Command\ChannelChangeKeyAction;
use Commercetools\Core\Request\Channels\Command\ChannelChangeNameAction;
use Commercetools\Core\Request\Channels\Command\ChannelRemoveRolesAction;
use Commercetools\Core\Request\Channels\Command\ChannelSetAddressAction;
use Commercetools\Core\Request\Channels\Command\ChannelSetRolesAction;

class ChannelUpdateRequestTest extends ApiTestCase
{
    /**
     * @param $key
     * @return ChannelDraft
     */
    protected function getDraft($key)
    {
        $draft = ChannelDraft::ofKey(
            'test-' . $this->getTestRun() . '-' . $key
        );

        return $draft;
    }

    protected function createChannel(ChannelDraft $draft)
    {
        $request = ChannelCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $channel = $request->mapResponse($response);

        $this->cleanupRequests[] = ChannelDeleteRequest::ofIdAndVersion(
            $channel->getId(),
            $channel->getVersion()
        );

        return $channel;
    }

    public function testChangeName()
    {
        $draft = $this->getDraft('change-name');
        $channel = $this->createChannel($draft);

        $name = $this->getTestRun() . '-new name';
        $request = ChannelUpdateRequest::ofIdAndVersion($channel->getId(), $channel->getVersion())
            ->addAction(
                ChannelChangeNameAction::ofName(
                    LocalizedString::ofLangAndText('en', $name)
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Channel\Channel', $result);
        $this->assertSame($name, $result->getName()->en);
        $this->assertNotSame($channel->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\Channel\Channel', $result);
    }

    public function testChangeDescription()
    {
        $draft = $this->getDraft('update-description');
        $channel = $this->createChannel($draft);


        $description = $this->getTestRun() . '-new description';
        $request = ChannelUpdateRequest::ofIdAndVersion($channel->getId(), $channel->getVersion())
            ->addAction(
                ChannelChangeDescriptionAction::ofDescription(
                    LocalizedString::ofLangAndText('en', $description)
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Channel\Channel', $result);
        $this->assertSame($description, $result->getDescription()->en);
        $this->assertNotSame($channel->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\Channel\Channel', $result);
    }

    public function testChangeKey()
    {
        $draft = $this->getDraft('update-key');
        $channel = $this->createChannel($draft);


        $key = $this->getTestRun() . '-new key';
        $request = ChannelUpdateRequest::ofIdAndVersion($channel->getId(), $channel->getVersion())
            ->addAction(ChannelChangeKeyAction::ofKey($key))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Channel\Channel', $result);
        $this->assertSame($key, $result->getKey());
        $this->assertNotSame($channel->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\Channel\Channel', $result);
    }

    public function testSetAddress()
    {
        $draft = $this->getDraft('set-address');
        $draft->setAddress(Address::of()->setCountry('US'));
        $channel = $this->createChannel($draft);

        $this->assertSame('US', $channel->getAddress()->getCountry());

        $address = Address::of()->setCountry('DE');
        $request = ChannelUpdateRequest::ofIdAndVersion($channel->getId(), $channel->getVersion())
            ->addAction(ChannelSetAddressAction::of()->setAddress($address))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Channel\Channel', $result);
        $this->assertSame('DE', $result->getAddress()->getCountry());
        $this->assertNotSame($channel->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\Channel\Channel', $result);
    }

    public function testAddRoles()
    {
        $draft = $this->getDraft('add-roles');
        $channel = $this->createChannel($draft);

        $roles = [ChannelRole::PRIMARY];
        $request = ChannelUpdateRequest::ofIdAndVersion($channel->getId(), $channel->getVersion())
            ->addAction(ChannelAddRolesAction::ofRoles($roles))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Channel\Channel', $result);
        $this->assertSame([ChannelRole::INVENTORY_SUPPLY, ChannelRole::PRIMARY], $result->getRoles());
        $this->assertNotSame($channel->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\Channel\Channel', $result);
    }

    public function testRemoveRoles()
    {
        $draft = $this->getDraft('remove-roles');
        $draft->setRoles([ChannelRole::INVENTORY_SUPPLY, ChannelRole::PRIMARY]);
        $channel = $this->createChannel($draft);

        $roles = [ChannelRole::INVENTORY_SUPPLY];
        $request = ChannelUpdateRequest::ofIdAndVersion($channel->getId(), $channel->getVersion())
            ->addAction(ChannelRemoveRolesAction::ofRoles($roles))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Channel\Channel', $result);
        $this->assertSame([ChannelRole::PRIMARY], $result->getRoles());
        $this->assertNotSame($channel->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\Channel\Channel', $result);
    }

    public function testSetRoles()
    {
        $draft = $this->getDraft('add-roles');
        $channel = $this->createChannel($draft);
        $this->assertSame([ChannelRole::INVENTORY_SUPPLY], $channel->getRoles());

        $roles = [ChannelRole::PRIMARY, ChannelRole::PRODUCT_DISTRIBUTION];
        $request = ChannelUpdateRequest::ofIdAndVersion($channel->getId(), $channel->getVersion())
            ->addAction(ChannelSetRolesAction::ofRoles($roles))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Channel\Channel', $result);
        $this->assertSame($roles, $result->getRoles());
        $this->assertNotSame($channel->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\Channel\Channel', $result);
    }
}
