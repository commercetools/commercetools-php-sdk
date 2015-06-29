<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 18:14
 */

namespace Sphere\Core\Request\Categories;

use Sphere\Core\Model\Category\CategoryReference;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Request\AbstractUpdateRequest;

/**
 * Class CategoryUpdateRequest
 * @package Sphere\Core\Request\Categories
 * @link http://dev.sphere.io/http-api-projects-categories.html#update-category
 */
class CategoryUpdateRequest extends AbstractUpdateRequest
{
    protected $resultClass = '\Sphere\Core\Model\Category\Category';

    /**
     * @param string $id
     * @param int $version
     * @param array $actions
     * @param Context $context
     */
    public function __construct($id, $version, array $actions = [], Context $context = null)
    {
        parent::__construct(CategoriesEndpoint::endpoint(), $id, $version, $actions, $context);
    }

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofIdAndVersion($id, $version, Context $context = null)
    {
        return new static($id, $version, [], $context);
    }
}
