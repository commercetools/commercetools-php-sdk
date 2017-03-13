<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Zones\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Zone\Location;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Zones\Command
 * @link https://dev.commercetools.com/http-api-projects-zones.html#remove-location
 * @method string getAction()
 * @method ZoneRemoveLocationAction setAction(string $action = null)
 * @method Location getLocation()
 * @method ZoneRemoveLocationAction setLocation(Location $location = null)
 */
class ZoneRemoveLocationAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'location' => [static::TYPE => Location::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('removeLocation');
    }

    /**
     * @param Location $location
     * @param Context|callable $context
     * @return ZoneRemoveLocationAction
     */
    public static function ofLocation(Location $location, $context = null)
    {
        return static::of($context)->setLocation($location);
    }
}
