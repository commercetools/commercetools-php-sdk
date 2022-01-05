<?php

namespace Commercetools\Core\Model\ProductSelection;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;

/**
 * @package Commercetools\Core\Model\ProductSelection
 * @link https://docs.commercetools.com/http-api-projects-productSelection.html#productselectiondraft
 * @method LocalizedString getName()
 * @method ProductSelectionDraft setName(LocalizedString $name = null)
 * @method string getKey()
 * @method ProductSelectionDraft setKey(string $key = null)
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
     * @param LocalizedString $name
     * @param Context|callable $context
     * @return ProductSelectionDraft
     */
    public static function ofName(
        LocalizedString $name,
        $context = null
    ) {
        return static::of($context)->setName($name);
    }
}
