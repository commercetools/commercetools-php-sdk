<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CustomerGroup;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;

/**
 * @package Commercetools\Core\Model\CustomerGroup
 * @link https://dev.commercetools.com/http-api-projects-customerGroups.html#create-a-customergroup
 * @method string getGroupName()
 * @method CustomerGroupDraft setGroupName(string $groupName = null)
 * @method string getKey()
 * @method CustomerGroupDraft setKey(string $key = null)
 * @method CustomFieldObjectDraft getCustom()
 * @method CustomerGroupDraft setCustom(CustomFieldObjectDraft $custom = null)
 */
class CustomerGroupDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'key' => [static::TYPE => 'string'],
            'groupName' => [static::TYPE => 'string'],
            'custom' => [static::TYPE => CustomFieldObjectDraft::class],
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
