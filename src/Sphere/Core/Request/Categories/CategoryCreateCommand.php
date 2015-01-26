<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 15:57
 */

namespace Sphere\Core\Request\Categories;


use Sphere\Core\Http\HttpMethod;
use Sphere\Core\Http\HttpRequestInterface;
use Sphere\Core\Http\JsonRequest;
use Sphere\Core\Request\AbstractApiRequest;

class CategoryCreateCommand extends AbstractApiRequest
{
    /**
     * @var mixed
     */
    protected $category;

    /**
     * @param mixed $category
     */
    public function __construct($category)
    {
        parent::__construct(CategoriesEndpoint::endpoint());
        $this->category = $category;
    }

    /**
     * @return JsonRequest
     */
    public function httpRequest()
    {
        return new JsonRequest(HttpMethod::POST, (string)$this->endpoint, $this->category);
    }
}
