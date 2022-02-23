<?php

namespace Commercetools\Core\Model\ProductSelection;

use Commercetools\Core\Model\Common\LocalizedString;

/**
 * @package Commercetools\Core\Model\ProductSelection
 *
 * @method LocalizedString getName()
 * @method IndividualProductSelectionType setName(LocalizedString $name = null)
 */
class IndividualProductSelectionType extends ProductSelectionType
{
    public function fieldDefinitions()
    {
        return [
            'name' => [static::TYPE => LocalizedString::class],
        ];
    }
}
