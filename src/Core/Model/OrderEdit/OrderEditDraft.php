<?php
/**
 *
 */

namespace Commercetools\Core\Model\OrderEdit;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use Commercetools\Core\Model\Order\OrderReference;

/**
 * @package Commercetools\Core\Model\OrderEdit
 *
 * @method string getKey()
 * @method OrderEditDraft setKey(string $key = null)
 * @method OrderReference getResource()
 * @method OrderEditDraft setResource(OrderReference $resource = null)
 * @method array getStagedActions()
 * @method OrderEditDraft setStagedActions(array $stagedActions = null)
 * @method CustomFieldObjectDraft getCustom()
 * @method OrderEditDraft setCustom(CustomFieldObjectDraft $custom = null)
 * @method string getComment()
 * @method OrderEditDraft setComment(string $comment = null)
 */
class OrderEditDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'key' => [static::TYPE => 'string'],
            'resource' => [static::TYPE => OrderReference::class],
            'stagedActions' => [static::TYPE => 'array'],
            'custom' => [static::TYPE => CustomFieldObjectDraft::class],
            'comment' => [static::TYPE => 'string']
        ];
    }
}
