<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 15:57
 */

namespace Sphere\Core\Request\Categories;


use Sphere\Core\Request\AbstractCreateCommand;

class CategoryCreateCommand extends AbstractCreateCommand
{
    /**
     * @param mixed $category
     */
    public function __construct($category)
    {
        parent::__construct(CategoriesEndpoint::endpoint(), $category);
    }
}
