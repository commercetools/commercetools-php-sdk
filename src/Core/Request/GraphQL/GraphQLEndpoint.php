<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Request\GraphQL;

use Commercetools\Core\Client\JsonEndpoint;

class GraphQLEndpoint
{
    /**
     * @return JsonEndpoint
     */
    public static function endpoint()
    {
        return new JsonEndpoint('graphql');
    }
}
