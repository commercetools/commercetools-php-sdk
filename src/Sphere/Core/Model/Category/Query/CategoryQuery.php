<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 23.01.15, 16:52
 */

namespace Sphere\Core\Model\Category\Query;




use Sphere\Core\Http\ClientRequest;
use Sphere\Core\Http\HttpMethod;
use Sphere\Core\Http\HttpRequest;
use Sphere\Core\Http\JsonEndpoint;
use Sphere\Core\Model\Category\Command\CategoriesEndpoint;

class CategoryQuery implements ClientRequest
{
    /**
     * @var JsonEndpoint
     */
    protected $endpoint;

    public function __construct()
    {
        $this->endpoint = CategoriesEndpoint::endpoint();
    }

    /**
     * @return CategoryQuery
     */
    public static function of()
    {
        return new static();
    }

    /**
     * @return HttpRequest
     */
    public function httpRequest()
    {
        return HttpRequest::of(HttpMethod::GET, $this->endpoint->endpoint());
    }


}
