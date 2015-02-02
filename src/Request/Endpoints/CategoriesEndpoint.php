<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 23.01.15, 16:25
 */

namespace Sphere\Core\Request\Endpoints;


use Sphere\Core\Http\JsonEndpoint;

/**
 * Class CategoriesEndpoint
 * @package Sphere\Core\Request\Categories
 */
class CategoriesEndpoint
{
    /**
     * @return JsonEndpoint
     */
    public static function endpoint()
    {
        return new JsonEndpoint('categories');
    }
}
