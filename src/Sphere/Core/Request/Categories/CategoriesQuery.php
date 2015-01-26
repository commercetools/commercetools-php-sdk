<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 23.01.15, 16:52
 */

namespace Sphere\Core\Request\Categories;

use Sphere\Core\Http\HttpMethod;
use Sphere\Core\Http\HttpRequest;
use Sphere\Core\Request\AbstractApiRequest;
use Sphere\Core\Request\QueryTrait;

class CategoriesQuery extends AbstractApiRequest
{
    use QueryTrait;

    /**
     * @param $where
     * @param $sort
     * @param $limit
     * @param $offset
     */
    public function __construct($where = null, $sort = null, $limit = null, $offset = null)
    {
        parent::__construct(CategoriesEndpoint::endpoint());
        $this->setQueryParams($where, $sort, $limit, $offset);
    }

    /**
     * @return string
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '?' . $this->getParamString();
    }

    /**
     * @return HttpRequest
     */
    public function httpRequest()
    {
        return new HttpRequest(HttpMethod::GET, $this->getPath());
    }
}
