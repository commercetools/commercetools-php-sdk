<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Error;

/**
 * Exeption for response with status code 409
 * @package Commercetools\Core\Error
 * @description
 * When trying to update a resource with a version which differs from the version stored on Composable Commerce,
 * the API will respond with status code 409.
 */
class ConcurrentModificationException extends ClientErrorException
{
    public function getCurrentVersion()
    {
        $error = $this->getErrorContainer()->getByCode(ConcurrentModificationError::CODE);
        if ($error instanceof ConcurrentModificationError) {
            return $error->getCurrentVersion();
        }
        return null;
    }
}
