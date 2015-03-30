<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Order;

use Sphere\Core\Model\Common\JsonObject;

/**
 * Class ParcelMeasurements
 * @package Sphere\Core\Model\Order
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
    public function getFields()
    {
        return [
            'heightInMillimeter' => [static::TYPE => 'int'],
            'lengthInMillimeter' => [static::TYPE => 'int'],
            'widthInMillimeter' => [static::TYPE => 'int'],
            'weightInGram' => [static::TYPE => 'int'],
        ];
    }
}
