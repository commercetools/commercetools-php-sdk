<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 17:02
 */

namespace Sphere\Core\Request\Categories;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractDeleteRequest;
use Sphere\Core\Model\Category\Category;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * @package Sphere\Core\Request\Categories
 * @apidoc http://dev.sphere.io/http-api-projects-categories.html#delete-category
 * @method Category mapResponse(ApiResponseInterface $response)
 */
class CategoryDeleteRequest extends AbstractDeleteRequest
{
    protected $resultClass = '\Sphere\Core\Model\Category\Category';

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     */
    public function __construct($id, $version, Context $context = null)
    {
        parent::__construct(CategoriesEndpoint::endpoint(), $id, $version, $context);
    }

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofIdAndVersion($id, $version, Context $context = null)
    {
        return new static($id, $version, $context);
    }
}
