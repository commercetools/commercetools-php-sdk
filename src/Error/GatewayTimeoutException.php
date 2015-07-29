<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Error;

/**
 * Exception for response for status code 504
 * @package Sphere\Core\Error
 * @description
 * This error might occur on long running processes such as deletion of resources with connections to other resources.
 */
class GatewayTimeoutException extends ServerErrorException
{

}
