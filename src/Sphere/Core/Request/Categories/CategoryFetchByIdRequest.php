<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 14:56
 */

namespace Sphere\Core\Request\Categories;


use Sphere\Core\Model\OfTrait;
use Sphere\Core\Request\AbstractFetchByIdRequest;

/**
 * Class CategoryFetchByIdRequest
 * @package Sphere\Core\Request\Categories
 * @method static CategoryDeleteByIdRequest of(string $id)
 */
class CategoryFetchByIdRequest extends AbstractFetchByIdRequest
{
    use OfTrait;
    /**
     * @param string $id
     */
    public function __construct($id)
    {
        parent::__construct(CategoriesEndpoint::endpoint(), $id);
    }
}
