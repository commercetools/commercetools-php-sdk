<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Zone;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Zone
 * @link https://dev.commercetools.com/http-api-projects-zones.html#location
 * @method string getCountry()
 * @method Location setCountry(string $country = null)
 * @method string getState()
 * @method Location setState(string $state = null)
 */
class Location extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'country' => [static::TYPE => 'string'],
            'state' => [static::TYPE => 'string'],
        ];
    }
}
