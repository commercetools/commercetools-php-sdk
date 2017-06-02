<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 23.01.15, 16:25
 */

namespace Commercetools\Core\Request\Categories;

use Commercetools\Core\Client\JsonEndpoint;

/**
 * @package Commercetools\Core\Request\Categories
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
