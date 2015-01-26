<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 18:14
 */

namespace Sphere\Core\Request\Categories;


use Sphere\Core\Request\AbstractUpdateCommand;

class CategoryUpdateCommand extends AbstractUpdateCommand
{

    public function __construct($endpoint, $id, $version, array $actions = [])
    {
        parent::__construct(CategoriesEndpoint::endpoint(), $id, $version, $actions);
    }
}
