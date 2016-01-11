<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CustomerGroup;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\CustomerGroup
 * @method string getGroupName()
 * @method CustomerGroupDraft setGroupName(string $groupName = null)
 */
class CustomerGroupDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'groupName' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param string $groupName
     * @param Context|callable $context
     * @return CustomerGroupDraft
     */
    public static function ofGroupName($groupName, $context = null)
    {
        return static::of($context)->setGroupName($groupName);
    }
}
