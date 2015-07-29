<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\CustomerGroup;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\JsonObject;

/**
 * @package Sphere\Core\Model\CustomerGroup
 * @method string getGroupName()
 * @method CustomerGroupDraft setGroupName(string $groupName = null)
 */
class CustomerGroupDraft extends JsonObject
{
    public function getFields()
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
    public function ofGroupName($groupName, $context = null)
    {
        return static::of($context)->setGroupName($groupName);
    }
}
