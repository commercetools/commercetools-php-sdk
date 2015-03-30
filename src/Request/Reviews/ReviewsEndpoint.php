<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Reviews;


use Sphere\Core\Client\JsonEndpoint;

/**
 * Class ReviewsEndpoint
 * @package Sphere\Core\Request\Reviews
 */
class ReviewsEndpoint
{
    /**
     * @return JsonEndpoint
     */
    public static function endpoint()
    {
        return new JsonEndpoint('reviews');
    }
}
