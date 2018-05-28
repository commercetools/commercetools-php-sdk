<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Channels\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Common\GeoLocation;

/**
 * @package Commercetools\Core\Request\Channels\Command
 *
 * @link https://docs.commercetools.com/http-api-projects-channels.html#set-geolocation
 * @method string getAction()
 * @method ChannelSetGeoLocation setAction(string $action = null)
 * @method GeoLocation getGeoLocation()
 * @method ChannelSetGeoLocation setGeoLocation(GeoLocation $geoLocation = null)
 */
class ChannelSetGeoLocation extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'geoLocation' => [static::TYPE => GeoLocation::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setGeoLocation');
    }
}
