<?php

namespace Commercetools\Core\Model\ProductSelection;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;

/**
 * @package Commercetools\Core\Model\ProductSelection
 * @link https://docs.commercetools.com/api/projects/product-selections#productselectiondraft
 * @method string getKey()
 * @method ProductSelectionDraft setKey(string $key = null)
 * @method LocalizedString getName()
 * @method ProductSelectionDraft setName(LocalizedString $name = null)
 */
class ProductSelectionDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'key' => [static::TYPE => 'string'],
            'name' => [static::TYPE => LocalizedString::class],
        ];
    }

    /**
     * @param $key
     * @param Context|callable $context
     * @return ProductSelectionDraft
     */
    public static function ofKey($key, $context = null)
    {
        return static::of($context)->setKey($key);
    }
}
