<?php
/**
 */

namespace Commercetools\Core\Error;

/**
 * @package Commercetools\Core\Error
 *
 * @method string getCode()
 * @method InvalidItemShippingDetailsError setCode(string $code = null)
 * @method string getMessage()
 * @method InvalidItemShippingDetailsError setMessage(string $message = null)
 * @method string getSubject()
 * @method InvalidItemShippingDetailsError setSubject(string $subject = null)
 * @method string getItemId()
 * @method InvalidItemShippingDetailsError setItemId(string $itemId = null)
 */
class InvalidItemShippingDetailsError extends ApiError
{
    const CODE = 'InvalidItemShippingDetails';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['subject'] = [static::TYPE => 'string'];
        $definitions['itemId'] = [static::TYPE => 'string'];

        return $definitions;
    }
}
