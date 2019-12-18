<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\Channel;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Channel\Channel;
use Commercetools\Core\Model\Channel\ChannelDraft;
use Commercetools\Core\Model\Channel\ChannelRole;
use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\GeoPoint;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use Commercetools\Core\Model\CustomField\FieldContainer;
use Commercetools\Core\Request\Channels\ChannelCreateRequest;
use Commercetools\Core\Request\Channels\ChannelDeleteRequest;
use Commercetools\Core\Request\Channels\ChannelUpdateRequest;
use Commercetools\Core\Request\Channels\Command\ChannelAddRolesAction;
use Commercetools\Core\Request\Channels\Command\ChannelChangeDescriptionAction;
use Commercetools\Core\Request\Channels\Command\ChannelChangeKeyAction;
use Commercetools\Core\Request\Channels\Command\ChannelChangeNameAction;
use Commercetools\Core\Request\Channels\Command\ChannelRemoveRolesAction;
use Commercetools\Core\Request\Channels\Command\ChannelSetAddressAction;
use Commercetools\Core\Request\Channels\Command\ChannelSetGeoLocation;
use Commercetools\Core\Request\Channels\Command\ChannelSetRolesAction;
use Commercetools\Core\Request\CustomField\Command\SetCustomFieldAction;
use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;

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

        $this->cleanupRequests[] = $this->deleteRequest = ChannelDeleteRequest::ofIdAndVersion(
            $channel->getId(),
            $channel->getVersion()
        );

        return $channel;
    }

    public function testChangeName()
    {
        $client = $this->getApiClient();

        ChannelFixture::withUpdateableChannel(
            $client,
            function (Channel $channel) use ($client) {
                $name = $this->getTestRun() . '-new name';
                $request = RequestBuilder::of()->channels()->update($channel)->addAction(
                    ChannelChangeNameAction::ofName(
                        LocalizedString::ofLangAndText('en', $name)
                    )
                );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Channel::class, $result);
                $this->assertSame($name, $result->getName()->en);
                $this->assertNotSame($channel->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testChangeDescription()
    {
        $client = $this->getApiClient();

        ChannelFixture::withUpdateableChannel(
            $client,
            function (Channel $channel) use ($client) {
                $description = $this->getTestRun() . '-new description';
                $request = RequestBuilder::of()->channels()->update($channel)->addAction(
                    ChannelChangeDescriptionAction::ofDescription(
                        LocalizedString::ofLangAndText('en', $description)
                    )
                );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Channel::class, $result);
                $this->assertSame($description, $result->getDescription()->en);
                $this->assertNotSame($channel->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testChangeKey()
    {
        $client = $this->getApiClient();

        ChannelFixture::withUpdateableChannel(
            $client,
            function (Channel $channel) use ($client) {
                $key = $this->getTestRun() . '-new key';
                $request = RequestBuilder::of()->channels()->update($channel)->addAction(
                    ChannelChangeKeyAction::ofKey($key)
                );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Channel::class, $result);
                $this->assertSame($key, $result->getKey());
                $this->assertNotSame($channel->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetAddress()
    {
        $client = $this->getApiClient();

        ChannelFixture::withUpdateableDraftChannel(
            $client,
            function (ChannelDraft $draft) {
                return $draft->setAddress(Address::of()->setCountry('US'));
            },
            function (Channel $channel) use ($client) {
                $this->assertSame('US', $channel->getAddress()->getCountry());

                $address = Address::of()->setCountry('DE');
                $request = RequestBuilder::of()->channels()->update($channel)->addAction(
                    ChannelSetAddressAction::of()->setAddress($address)
                );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Channel::class, $result);
                $this->assertSame('DE', $result->getAddress()->getCountry());
                $this->assertNotSame($channel->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testAddRoles()
    {
        $client = $this->getApiClient();

        ChannelFixture::withUpdateableChannel(
            $client,
            function (Channel $channel) use ($client) {
                $roles = [ChannelRole::PRIMARY];
                $request = RequestBuilder::of()->channels()->update($channel)->addAction(
                    ChannelAddRolesAction::ofRoles($roles)
                );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Channel::class, $result);
                $this->assertSame([ChannelRole::INVENTORY_SUPPLY, ChannelRole::PRIMARY], $result->getRoles());
                $this->assertNotSame($channel->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testRemoveRoles()
    {
        $client = $this->getApiClient();

        ChannelFixture::withUpdateableDraftChannel(
            $client,
            function (ChannelDraft $draft) {
                return $draft->setRoles([ChannelRole::INVENTORY_SUPPLY, ChannelRole::PRIMARY]);
            },
            function (Channel $channel) use ($client) {
                $roles = [ChannelRole::INVENTORY_SUPPLY];
                $request = RequestBuilder::of()->channels()->update($channel)->addAction(
                    ChannelRemoveRolesAction::ofRoles($roles)
                );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Channel::class, $result);
                $this->assertSame([ChannelRole::PRIMARY], $result->getRoles());
                $this->assertNotSame($channel->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetRoles()
    {
        $client = $this->getApiClient();

        ChannelFixture::withUpdateableChannel(
            $client,
            function (Channel $channel) use ($client) {
                $this->assertSame([ChannelRole::INVENTORY_SUPPLY], $channel->getRoles());

                $roles = [ChannelRole::PRIMARY, ChannelRole::PRODUCT_DISTRIBUTION];
                $request = RequestBuilder::of()->channels()->update($channel)->addAction(
                    ChannelSetRolesAction::ofRoles($roles)
                );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Channel::class, $result);
                $this->assertSame($roles, $result->getRoles());
                $this->assertNotSame($channel->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

//    TODO to migrate: depends of Type
    public function testChannelCustom()
    {
        $customType = $this->getType('channel_custom', 'channel');

        $draft = $this->getDraft('channel-custom');
        $draft->setCustom(
            CustomFieldObjectDraft::ofTypeKeyAndFields(
                'channel_custom',
                FieldContainer::of()->setTestField('value')
            )
        );
        $channel = $this->createChannel($draft);

        $this->assertInstanceOf(Channel::class, $channel);
        $this->assertSame('value', $channel->getCustom()->getFields()->getTestField());

        $request = ChannelUpdateRequest::ofIdAndVersion($channel->getId(), $channel->getVersion())
            ->addAction(
                SetCustomTypeAction::ofTypeKey('channel_custom')
                    ->setFields(
                        FieldContainer::of()
                            ->set('testField', 'new value')
                    )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $channel = $request->mapResponse($response);
        $this->deleteRequest->setVersion($channel->getVersion());

        $this->assertInstanceOf(Channel::class, $channel);
        $this->assertSame('new value', $channel->getCustom()->getFields()->getTestField());

        $request = ChannelUpdateRequest::ofIdAndVersion($channel->getId(), $channel->getVersion())
            ->addAction(SetCustomFieldAction::ofName('testField')->setValue('new value 2'))
        ;
        $response = $request->executeWithClient($this->getClient());
        $channel = $request->mapResponse($response);
        $this->deleteRequest->setVersion($channel->getVersion());

        $this->assertInstanceOf(Channel::class, $channel);
        $this->assertSame('new value 2', $channel->getCustom()->getFields()->getTestField());
    }

    public function testSetGeoLocation()
    {
        $client = $this->getApiClient();
        $brandenburgerTor = [13.37770, 52.51627];
        $friedrichstadtPalast = [13.38881, 52.52394];

        ChannelFixture::withUpdateableDraftChannel(
            $client,
            function (ChannelDraft $draft) use ($brandenburgerTor) {
                return $draft->setGeoLocation(GeoPoint::of()->setCoordinates($brandenburgerTor));
            },
            function (Channel $channel) use ($client, $friedrichstadtPalast) {
                $request = RequestBuilder::of()->channels()->update($channel)
                    ->addAction(
                        ChannelSetGeoLocation::of()->setGeoLocation(GeoPoint::of()
                            ->setCoordinates($friedrichstadtPalast))
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Channel::class, $result);
                $this->assertSame($friedrichstadtPalast, $result->getGeoLocation()->getCoordinates());
                $this->assertNotSame($channel->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }
}
