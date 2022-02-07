<?php

namespace Commercetools\Core\Model\ProductSelection;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\ProductSelection
 *
 * @method ProductSelectionTypeEnum getType()
 * @method ProductSelectionType setType(ProductSelectionTypeEnum $type = null)
 */
class ProductSelectionType extends JsonObject
{
    const INPUT_TYPE = '';

    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => ProductSelectionTypeEnum::class],
        ];
    }
}
