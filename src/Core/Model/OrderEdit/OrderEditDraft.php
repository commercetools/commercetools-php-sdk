<?php
/**
 *
 */

namespace Commercetools\Core\Model\OrderEdit;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use Commercetools\Core\Model\Order\OrderReference;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderUpdateActionCollection;

/**
 * @package Commercetools\Core\Model\OrderEdit
 *
 * @method string getKey()
 * @method OrderEditDraft setKey(string $key = null)
 * @method OrderReference getResource()
 * @method OrderEditDraft setResource(OrderReference $resource = null)
 * @method StagedOrderUpdateActionCollection getStagedActions()
 * @method OrderEditDraft setStagedActions(StagedOrderUpdateActionCollection $stagedActions = null)
 * @method CustomFieldObjectDraft getCustom()
 * @method OrderEditDraft setCustom(CustomFieldObjectDraft $custom = null)
 * @method string getComment()
 * @method OrderEditDraft setComment(string $comment = null)
 * @method bool getDryRun()
 * @method OrderEditDraft setDryRun(bool $dryRun = null)
 */
class OrderEditDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'key' => [static::TYPE => 'string', static::OPTIONAL => true],
            'resource' => [static::TYPE => OrderReference::class],
            'stagedActions' => [static::TYPE => StagedOrderUpdateActionCollection::class, static::OPTIONAL => true],
            'custom' => [static::TYPE => CustomFieldObjectDraft::class, static::OPTIONAL => true],
            'comment' => [static::TYPE => 'string', static::OPTIONAL => true],
            'dryRun' => [static::TYPE => 'bool', static::OPTIONAL => true],
        ];
    }

    /**
     * @param OrderReference $resource
     * @param Context|callable $context
     * @return OrderEditDraft
     */
    public static function ofResource(OrderReference $resource, $context = null)
    {
        return static::of($context)->setResource($resource);
    }
}
