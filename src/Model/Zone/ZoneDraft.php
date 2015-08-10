<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Zone;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Zone
 * @method string getName()
 * @method ZoneDraft setName(string $name = null)
 * @method string getDescription()
 * @method ZoneDraft setDescription(string $description = null)
 * @method LocationCollection getLocations()
 * @method ZoneDraft setLocations(LocationCollection $locations = null)
 */
class ZoneDraft extends JsonObject
{
    public function getPropertyDefinitions()
    {
        return [
            'name' => [static::TYPE => 'string'],
            'description' => [static::TYPE => 'string'],
            'locations' => [static::TYPE => '\Commercetools\Core\Model\Zone\LocationCollection'],
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
