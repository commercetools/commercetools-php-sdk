<?php


namespace Commercetools\Core\Error;

/**
 * @package Commercetools\Core\Error
 *
 * @method string getCode()
 * @method QueryTimedOutError setCode(string $code = null)
 * @method string getMessage()
 * @method QueryTimedOutError setMessage(string $message = null)
 */
class QueryTimedOutError extends ApiError
{
    const CODE = 'QueryTimedOut';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();

        return $definitions;
    }
}
