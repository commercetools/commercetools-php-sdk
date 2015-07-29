<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Error;

/**
 * Exeption for response with status code 409
 * @package Sphere\Core\Error
 * @description
 * When trying to update a resource with a version which differs from the version stored at the commercetools
 * platform the API will respond with status code 409.
 */
class ConcurrentModificationException extends ClientErrorException
{

}
