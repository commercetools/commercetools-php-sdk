<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 *
 * @method string getType()
 * @method GeoPoint setType(string $type = null)
 * @method array getCoordinates()
 * @method GeoPoint setCoordinates(array $coordinates = null)
 */
class GeoPoint extends GeoLocation
{
    const TYPE_NAME = 'Point';
}
