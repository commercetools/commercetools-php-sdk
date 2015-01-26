<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 14:56
 */

namespace Sphere\Core\Request\Categories;


use Sphere\Core\Request\AbstractFetchByIdCommand;

class CategoryFetchByIdCommand extends AbstractFetchByIdCommand
{
    /**
     * @param mixed $id
     */
    public function __construct($id)
    {
        parent::__construct(CategoriesEndpoint::endpoint(), $id);
    }
}
