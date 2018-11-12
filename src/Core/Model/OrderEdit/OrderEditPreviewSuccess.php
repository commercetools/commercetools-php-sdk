<?php
/**
 *
 */

namespace Commercetools\Core\Model\OrderEdit;

use Commercetools\Core\Model\Message\MessageCollection;

/**
 * @package Commercetools\Core\Model\OrderEdit
 *
 * @method StagedOrder getPreview()
 * @method OrderEditPreviewSuccess setPreview(StagedOrder $preview = null)
 * @method MessageCollection getMessagePayloads()
 * @method OrderEditPreviewSuccess setMessagePayloads(MessageCollection $messagePayloads = null)
 * @method string getType()
 * @method OrderEditPreviewSuccess setType(string $type = null)
 */
class OrderEditPreviewSuccess extends OrderEditResult
{
    const ORDER_EDIT_RESULT_TYPE = 'PreviewSuccess';

    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string'],
            'preview' => [static::TYPE => StagedOrder::class],
            'messagePayloads' => [static::TYPE => MessageCollection::class]
        ];
    }
}
