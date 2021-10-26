<?php


namespace Commercetools\Core\Error;


class QueryTimedOutError extends ApiError
{
    const CODE = 'QueryTimedOut';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();

        return $definitions;
    }
}
