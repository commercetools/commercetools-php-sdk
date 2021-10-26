<?php

namespace Commercetools\Core\Error;

/**
 * @package Commercetools\Core\Error
 *
 * @method string getCode()
 * @method ProjectNotConfiguredForLanguagesError setCode(string $code = null)
 * @method string getMessage()
 * @method ProjectNotConfiguredForLanguagesError setMessage(string $message = null)
 * @method array getLanguages()
 * @method ProjectNotConfiguredForLanguagesError setLanguages(array $languages = null)
 */
class ProjectNotConfiguredForLanguagesError extends ApiError
{
    const CODE = 'ProjectNotConfiguredForLanguages';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['languages'] = [static::TYPE => 'array'];

        return $definitions;
    }
}
