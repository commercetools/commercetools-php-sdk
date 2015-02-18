<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 18:14
 */

namespace Sphere\Core\Request\Categories;

use Sphere\Core\Model\Category\CategoryReference;
use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Request\AbstractUpdateRequest;

/**
 * Class CategoryUpdateRequest
 * @package Sphere\Core\Request\Categories
 * @method static CategoryUpdateRequest of(string $id, int $version, array $actions = [])
 */
class CategoryUpdateRequest extends AbstractUpdateRequest
{
    /**
     * @param string $id
     * @param int $version
     * @param array $actions
     */
    public function __construct($id, $version, array $actions = [])
    {
        parent::__construct(CategoriesEndpoint::endpoint(), $id, $version, $actions);
    }
}
