<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Zone;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\JsonObject;

/**
 * @package Sphere\Core\Model\Zone
 * @method string getName()
 * @method ZoneDraft setName(string $name = null)
 * @method string getDescription()
 * @method ZoneDraft setDescription(string $description = null)
 * @method LocationCollection getLocations()
 * @method ZoneDraft setLocations(LocationCollection $locations = null)
 */
class ZoneDraft extends JsonObject
{
    public function getFields()
    {
        return [
            'name' => [static::TYPE => 'string'],
            'description' => [static::TYPE => 'string'],
            'locations' => [static::TYPE => '\Sphere\Core\Model\Zone\LocationCollection'],
        ];
    }


    /**
     * @param string $name
     * @param LocationCollection $locations
     * @param Context|callable $context
     * @return ZoneDraft
     */
    public static function ofNameAndLocations($name, LocationCollection $locations, $context = null)
    {
        return static::of($context)->setName($name)->setLocations($locations);
    }
}
