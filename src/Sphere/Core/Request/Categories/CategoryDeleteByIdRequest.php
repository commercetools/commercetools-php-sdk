<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 17:02
 */

namespace Sphere\Core\Request\Categories;


use Sphere\Core\Model\VersionedInterface;
use Sphere\Core\Request\AbstractDeleteByIdRequest;

class CategoryDeleteByIdRequest extends AbstractDeleteByIdRequest
{
    /**
     * @param string $id
     * @param int $version
     */
    public function __construct($id, $version)
    {
        parent::__construct(CategoriesEndpoint::endpoint(), $id, $version);
    }
}
