<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Zones\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Zone\Location;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Zones\Command
 * @link https://docs.commercetools.com/http-api-projects-zones.html#add-location
 * @method string getAction()
 * @method ZoneAddLocationAction setAction(string $action = null)
 * @method Location getLocation()
 * @method ZoneAddLocationAction setLocation(Location $location = null)
 */
class ZoneAddLocationAction extends AbstractAction
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
        $this->setAction('addLocation');
    }

    /**
     * @param Location $location
     * @param Context|callable $context
     * @return ZoneAddLocationAction
     */
    public static function ofLocation(Location $location, $context = null)
    {
        return static::of($context)->setLocation($location);
    }
}
