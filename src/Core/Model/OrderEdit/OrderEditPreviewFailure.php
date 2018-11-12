<?php
/**
 *
 */

namespace Commercetools\Core\Model\OrderEdit;

use Commercetools\Core\Error\ErrorContainer;

/**
 * @package Commercetools\Core\Model\OrderEdit
 *
 * @method ErrorContainer getErrors()
 * @method OrderEditPreviewFailure setErrors(ErrorContainer $errors = null)
 * @method string getType()
 * @method OrderEditPreviewFailure setType(string $type = null)
 */
class OrderEditPreviewFailure extends OrderEditResult
{
    const ORDER_EDIT_RESULT_TYPE = 'PreviewFailure';

    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string'],
            'errors' => [static::TYPE => ErrorContainer::class]
        ];
    }
}
