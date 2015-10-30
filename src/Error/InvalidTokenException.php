<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Error;

/**
 * Exception for status code 401
 * @package Commercetools\Core\Error
 * @description
 * Typically happens when the oauth token is no more valid
 */
class InvalidTokenException extends UnauthorizedException
{
}
