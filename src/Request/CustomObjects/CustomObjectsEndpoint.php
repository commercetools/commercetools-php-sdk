<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CustomObjects;


use Commercetools\Core\Client\JsonEndpoint;

/**
 * @package Commercetools\Core\Request\CustomObjects
 */
class CustomObjectsEndpoint
{
    /**
     * @return JsonEndpoint
     */
    public static function endpoint()
    {
        return new JsonEndpoint('custom-objects');
    }
}
