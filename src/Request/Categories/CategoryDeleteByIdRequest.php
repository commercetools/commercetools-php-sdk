<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 17:02
 */

namespace Sphere\Core\Request\Categories;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractDeleteByIdRequest;

/**
 * Class CategoryDeleteByIdRequest
 * @package Sphere\Core\Request\Categories
 * @method static CategoryDeleteByIdRequest of(string $id, int $version)
 */
class CategoryDeleteByIdRequest extends AbstractDeleteByIdRequest
{
    protected $resultClass = '\Sphere\Core\Model\Category\Category';

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     */
    public function __construct($id, $version, Context $context = null)
    {
        parent::__construct(CategoriesEndpoint::endpoint(), $id, $version, $context);
    }
}
