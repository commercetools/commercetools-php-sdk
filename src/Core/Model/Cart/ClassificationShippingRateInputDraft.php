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
 * @link http://dev.commercetools.com/http-api-projects-carts.html#classificationshippingrateinputdraft
 * @method string getType()
 * @method ClassificationShippingRateInputDraft setType(string $type = null)
 * @method string getKey()
 * @method ClassificationShippingRateInputDraft setKey(string $key = null)
 * @method LocalizedString getLabel()
 * @method ClassificationShippingRateInputDraft setLabel(LocalizedString $label = null)
 */
class ClassificationShippingRateInputDraft extends ShippingRateInputDraft
{
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
     * @return ClassificationShippingRateInputDraft
     */
    public static function ofKeyAndLabel($key, $label, $context = null)
    {
        return static::ofType(ClassificationShippingRateInput::INPUT_TYPE, $context)
            ->setKey($key)
            ->setLabel($label);
    }
}
