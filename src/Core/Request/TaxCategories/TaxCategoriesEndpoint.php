<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\TaxCategories;

use Commercetools\Core\Client\JsonEndpoint;

/**
 * @package Commercetools\Core\Request\TaxCategories
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
