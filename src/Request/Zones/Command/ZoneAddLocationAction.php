<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Zones\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Zone\Location;
use Sphere\Core\Request\AbstractAction;

/**
 * Class ZoneAddLocationAction
 * @package Sphere\Core\Request\Zones\Command
 * 
 * @method string getAction()
 * @method ZoneAddLocationAction setAction(string $action = null)
 * @method Location getLocation()
 * @method ZoneAddLocationAction setLocation(Location $location = null)
 */
class ZoneAddLocationAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'location' => [static::TYPE => '\Sphere\Core\Model\Zone\Location'],
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
