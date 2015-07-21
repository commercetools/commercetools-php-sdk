<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Zone;

use Sphere\Core\Model\Common\JsonObject;

/**
 * @package Sphere\Core\Model\Zone
 * @link http://dev.sphere.io/http-api-projects-zones.html#location
 * @method string getCountry()
 * @method Location setCountry(string $country = null)
 * @method string getState()
 * @method Location setState(string $state = null)
 */
class Location extends JsonObject
{
    public function getFields()
    {
        return [
            'country' => [static::TYPE => 'string'],
            'state' => [static::TYPE => 'string'],
        ];
    }
}
