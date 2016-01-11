<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Error;

/**
 * Exception for response for status code 504
 * @package Commercetools\Core\Error
 * @description
 * This error might occur on long running processes such as deletion of resources with connections to other resources.
 */
class GatewayTimeoutException extends ServerErrorException
{
}
