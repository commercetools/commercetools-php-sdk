<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Error;

/**
 * Exception for response with status code 503
 * @package Sphere\Core\Error
 * @description
 * The commercetools platform is currently not available
 */
class ServiceUnavailableException extends ServerErrorException
{

}
