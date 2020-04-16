<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Error;

/**
 * Base exception for all responses with http status code 4xx
 * @package Commercetools\Core\Error
 */
class ClientErrorException extends ApiServiceException
{
    public function getErrorContainer()
    {
        $errors = parent::getErrors();

        return ErrorContainer::fromArray($errors);
    }
}
