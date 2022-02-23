<?php

namespace Commercetools\Core\Model\Project;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Project
 *
 * @method int getDeleteDaysAfterLastModification()
 * @method ShoppingListsConfiguration setDeleteDaysAfterLastModification(int $deleteDaysAfterLastModification = null)
 */
class ShoppingListsConfiguration extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'deleteDaysAfterLastModification' => [static::TYPE => 'int', static::OPTIONAL => true],
        ];
    }
}
