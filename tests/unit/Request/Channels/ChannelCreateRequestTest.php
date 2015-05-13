<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Channels;


use Sphere\Core\Model\Channel\ChannelDraft;
use Sphere\Core\RequestTestCase;

class ChannelCreateRequestTest extends RequestTestCase
{
    const CHANNEL_CREATE_REQUEST = '\Sphere\Core\Request\Channels\ChannelCreateRequest';

    protected function getDraft()
    {
        return ChannelDraft::fromArray(json_decode(
            '{
                "key": "my-channel",
                "roles": ["InventorySupply", "Primary"],
                "name": {
                    "en": "myChannel"
                },
                "description": {
                    "en": "My Channel"
                }
            }',
            true
        ));
    }

    public function testMapResult()
    {
        $result = $this->mapResult(static::CHANNEL_CREATE_REQUEST, [$this->getDraft()]);
        $this->assertInstanceOf('\Sphere\Core\Model\Channel\Channel', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(static::CHANNEL_CREATE_REQUEST, [$this->getDraft()]);
        $this->assertNull($result);
    }
}
