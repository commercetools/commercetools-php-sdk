<?php
/**
 *
 */

namespace Commercetools\Core\Model\OrderEdit;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\OrderEdit
 *
 * @method string getType()
 * @method OrderEditResult setType(string $type = null)
 */
class OrderEditResult extends JsonObject
{
    const ORDER_EDIT_RESULT_TYPE = '';

    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     * @return static
     */
    public static function fromArray(array $data, $context = null)
    {
        if (get_called_class() == OrderEditResult::class && isset($data['type'])) {
            $className = static::resultType($data['type']);
            if (class_exists($className)) {
                return new $className($data, $context);
            }
        }
        return new static($data, $context);
    }

    protected static function resultType($typeId)
    {
        $types = [
            OrderEditNotProcessed::ORDER_EDIT_RESULT_TYPE => OrderEditNotProcessed::class,
            OrderEditPreviewFailure::ORDER_EDIT_RESULT_TYPE => OrderEditPreviewFailure::class,
            OrderEditPreviewSuccess::ORDER_EDIT_RESULT_TYPE => OrderEditPreviewSuccess::class,
            OrderEditApplied::ORDER_EDIT_RESULT_TYPE => OrderEditApplied::class,

        ];
        return isset($types[$typeId]) ? $types[$typeId] : OrderEditResult::class;
    }
}
