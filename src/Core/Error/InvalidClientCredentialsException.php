<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Error;

/**
 * Exception for response with status code 401
 * @package Commercetools\Core\Error
 * @description
 * Typically wrong credentials or scope used
 */
class InvalidClientCredentialsException extends UnauthorizedException
{
}
