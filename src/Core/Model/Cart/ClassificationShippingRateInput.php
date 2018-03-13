<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocalizedString;

/**
 * @package Commercetools\Core\Model\Cart
 * @link http://dev.commercetools.com/http-api-projects-carts.html#classificationshippingrateinput
 * @method string getType()
 * @method ClassificationShippingRateInput setType(string $type = null)
 * @method string getKey()
 * @method ClassificationShippingRateInput setKey(string $key = null)
 * @method LocalizedString getLabel()
 * @method ClassificationShippingRateInput setLabel(LocalizedString $label = null)
 */
class ClassificationShippingRateInput extends ShippingRateInput
{
    const INPUT_TYPE = 'Classification';

    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string'],
            'key' => [static::TYPE => 'string'],
            'label' => [static::TYPE => LocalizedString::class]
        ];
    }

    /**
     * @param $key
     * @param $label
     * @param Context|callable $context
     * @return ClassificationShippingRateInput
     */
    public static function ofKeyAndLabel($key, $label, $context = null)
    {
        return static::ofType(static::INPUT_TYPE, $context)->setKey($key)->setLabel($label);
    }
}
