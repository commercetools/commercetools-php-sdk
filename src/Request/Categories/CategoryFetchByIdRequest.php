<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 14:56
 */

namespace Sphere\Core\Request\Categories;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractFetchByIdRequest;

/**
 * Class CategoryFetchByIdRequest
 * @package Sphere\Core\Request\Categories
 * @method static CategoryFetchByIdRequest of(string $id)
 */
class CategoryFetchByIdRequest extends AbstractFetchByIdRequest
{
    protected $resultClass = '\Sphere\Core\Model\Category\Category';

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(CategoriesEndpoint::endpoint(), $id, $context);
    }
}
