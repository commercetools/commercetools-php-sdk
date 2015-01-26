<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 17:02
 */

namespace Sphere\Core\Request\Categories;


use Sphere\Core\Request\AbstractDeleteByIdCommand;

class CategoryDeleteByIdCommand extends AbstractDeleteByIdCommand
{
    /**
     * @param mixed $id
     * @param mixed $version
     */
    public function __construct($id, $version)
    {
        parent::__construct(CategoriesEndpoint::endpoint(), $id, $version);
    }
}
