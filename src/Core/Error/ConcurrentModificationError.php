<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Error;

/**
 * @package Commercetools\Core\Error
 *
 * @method string getCode()
 * @method ConcurrentModificationError setCode(string $code = null)
 * @method string getMessage()
 * @method ConcurrentModificationError setMessage(string $message = null)
 * @method int getCurrentVersion()
 * @method ConcurrentModificationError setCurrentVersion(int $currentVersion = null)
 */
class ConcurrentModificationError extends ApiError
{
    const CODE = 'ConcurrentModification';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['currentVersion'] = [static::TYPE => 'int'];

        return $definitions;
    }
}
