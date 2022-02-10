<?php

namespace Commercetools\Core\Model\ProductSelection;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\ProductSelection
 *
 * @method string getLabel()
 * @method ProductSelectionType setLabel(string $label = null)
 * @method string getKey()
 * @method ProductSelectionType setKey(string $key = null)
 * @method ProductSelectionType getType()
 * @method ProductSelectionType setType(ProductSelectionType $type = null)
 */
class ProductSelectionType extends JsonObject
{
    const INDIVIDUAL = 'individual';

    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => ProductSelectionType::class],
        ];
    }
}
