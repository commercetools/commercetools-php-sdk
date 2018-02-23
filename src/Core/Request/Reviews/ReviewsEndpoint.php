<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Reviews;

use Commercetools\Core\Client\JsonEndpoint;

/**
 * @package Commercetools\Core\Request\Reviews
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
