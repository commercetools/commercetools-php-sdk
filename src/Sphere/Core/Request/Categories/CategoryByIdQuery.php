<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 14:56
 */

namespace Sphere\Core\Request\Categories;


use Sphere\Core\Http\HttpMethod;
use Sphere\Core\Http\HttpRequest;
use Sphere\Core\Http\HttpRequestInterface;
use Sphere\Core\Request\AbstractApiRequest;

class CategoryByIdQuery extends AbstractApiRequest
{
    protected $id;

    /**
     * @param mixed $id
     */
    public function __construct($id)
    {
        parent::__construct(CategoriesEndpoint::endpoint());
        $this->setId($id);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * @return HttpRequestInterface
     */
    public function httpRequest()
    {
        return new HttpRequest(HttpMethod::GET, (string)$this->getEndpoint() . '/' . $this->getId());
    }

}
