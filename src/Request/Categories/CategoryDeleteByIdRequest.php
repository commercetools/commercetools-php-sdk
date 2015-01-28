<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 17:02
 */

namespace Sphere\Core\Request\Categories;


use Sphere\Core\Model\OfTrait;
use Sphere\Core\Request\AbstractDeleteByIdRequest;

/**
 * Class CategoryDeleteByIdRequest
 * @package Sphere\Core\Request\Categories
 * @method static CategoryDeleteByIdRequest of(string $id, int $version)
 */
class CategoryDeleteByIdRequest extends AbstractDeleteByIdRequest
{
    use OfTrait;
    /**
     * @param string $id
     * @param int $version
     */
    public function __construct($id, $version)
    {
        parent::__construct(CategoriesEndpoint::endpoint(), $id, $version);
    }
}
