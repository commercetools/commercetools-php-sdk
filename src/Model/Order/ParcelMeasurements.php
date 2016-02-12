<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Order
 * @link http://dev.commercetools.com/http-api-projects-orders.html#parcel-measurements
 * @method int getHeightInMillimeter()
 * @method ParcelMeasurements setHeightInMillimeter(int $heightInMillimeter = null)
 * @method int getLengthInMillimeter()
 * @method ParcelMeasurements setLengthInMillimeter(int $lengthInMillimeter = null)
 * @method int getWidthInMillimeter()
 * @method ParcelMeasurements setWidthInMillimeter(int $widthInMillimeter = null)
 * @method int getWeightInGram()
 * @method ParcelMeasurements setWeightInGram(int $weightInGram = null)
 */
class ParcelMeasurements extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'heightInMillimeter' => [static::TYPE => 'int'],
            'lengthInMillimeter' => [static::TYPE => 'int'],
            'widthInMillimeter' => [static::TYPE => 'int'],
            'weightInGram' => [static::TYPE => 'int'],
        ];
    }
}
