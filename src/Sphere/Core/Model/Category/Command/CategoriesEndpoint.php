<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 23.01.15, 16:25
 */

namespace Sphere\Core\Model\Category\Command;


use Sphere\Core\Http\JsonEndpoint;

class CategoriesEndpoint
{
    /**
     * @return JsonEndpoint
     */
    public static function endpoint()
    {
        return JsonEndpoint::of('categories');
    }
}
