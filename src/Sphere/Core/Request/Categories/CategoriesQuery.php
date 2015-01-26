<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 23.01.15, 16:52
 */

namespace Sphere\Core\Model\Categories;

use Sphere\Core\Http\HttpMethod;
use Sphere\Core\Http\HttpRequest;
use Sphere\Core\Request\AbstractApiRequest;

class CategoriesQuery extends AbstractApiRequest
{
    public function __construct($where = null, $sort = null, $limit = null, $offset = null)
    {
        parent::__construct(CategoriesEndpoint::endpoint());
        $this->addParam('where', $where);
        $this->addParam('sort', $sort);
        $this->addParam('limit', $limit);
        $this->addParam('offset', $offset);
    }

    public function getPath()
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
