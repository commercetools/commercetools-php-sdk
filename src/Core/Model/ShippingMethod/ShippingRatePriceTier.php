<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShippingMethod;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Zone\ZoneReference;

/**
 * @package Commercetools\Core\Model\ShippingMethod
 * @link https://dev.commercetools.com/http-api-projects-shippingMethods.html#shippingratepricetier
 * @method ZoneReference getZone()
 * @method ZoneRateDraft setZone(ZoneReference $zone = null)
 * @method ShippingRateDraftCollection getShippingRates()
 * @method ZoneRateDraft setShippingRates(ShippingRateDraftCollection $shippingRates = null)
 * @method string getType()
 * @method ShippingRatePriceTier setType(string $type = null)
 */
class ShippingRatePriceTier extends JsonObject
{
    const INPUT_TYPE = '';

    /**
     * @inheritDoc
     */
    public function __construct(array $data = [], $context = null)
    {
        if (static::INPUT_TYPE != '' && !isset($data[static::TYPE])) {
            $data[static::TYPE] = static::INPUT_TYPE;
        }
        parent::__construct($data, $context);
    }

    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     * @return static
     */
    public static function fromArray(array $data, $context = null)
    {
        if (get_called_class() == ShippingRatePriceTier::class && isset($data[static::TYPE])) {
            $className = static::inputType($data[static::TYPE]);
            if (class_exists($className)) {
                return new $className($data, $context);
            }
        }
        return new static($data, $context);
    }

    protected static function inputType($type)
    {
        $types = [
            CartValue::INPUT_TYPE => CartValue::class,
            CartClassification::INPUT_TYPE => CartClassification::class,
            CartScore::INPUT_TYPE => CartScore::class,
        ];
        return isset($types[$type]) ? $types[$type] : ShippingRatePriceTier::class;
    }
}
