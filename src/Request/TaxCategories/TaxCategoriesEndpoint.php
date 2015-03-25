<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\TaxCategories;


use Sphere\Core\Client\JsonEndpoint;

/**
 * Class TaxCategoriesEndpoint
 * @package Sphere\Core\Request\TaxCategories
 */
class TaxCategoriesEndpoint
{
    /**
     * @return JsonEndpoint
     */
    public static function endpoint()
    {
        return new JsonEndpoint('tax-categories');
    }
}
