<?php
/**
 *
 */

namespace Commercetools\Core\Model\OrderEdit;

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

    /**
     * @inheritDoc
     */
    public function __construct(array $data = [], $context = null)
    {
        if (static::ORDER_EDIT_RESULT_TYPE != '' && !isset($data[static::TYPE])) {
            $data[static::TYPE] = static::ORDER_EDIT_RESULT_TYPE;
        }
        parent::__construct($data, $context);
    }

    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string'],
        ];
    }
}
