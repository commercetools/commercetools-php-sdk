<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 18:14
 */

namespace Sphere\Core\Request\Categories;


use Sphere\Core\Request\AbstractUpdateRequest;

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
