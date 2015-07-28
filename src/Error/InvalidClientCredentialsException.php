<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Error;

/**
 * Exception for response with status code 401
 * @package Sphere\Core\Error
 * @description
 * Typically wrong credentials or scope used
 */
class InvalidClientCredentialsException extends UnauthorizedException
{

}
