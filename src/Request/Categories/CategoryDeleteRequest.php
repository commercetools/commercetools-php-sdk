<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 26.01.15, 17:02
 */

namespace Commercetools\Core\Request\Categories;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractDeleteRequest;
use Commercetools\Core\Model\Category\Category;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\Categories
 * @link http://dev.commercetools.com/http-api-projects-categories.html#delete-category
 * @method Category mapResponse(ApiResponseInterface $response)
 */
class CategoryDeleteRequest extends AbstractDeleteRequest
{
    protected $resultClass = '\Commercetools\Core\Model\Category\Category';

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     */
    public function __construct($id, $version, Context $context = null)
    {
        parent::__construct(CategoriesEndpoint::endpoint(), $id, $version, $context);
    }

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofIdAndVersion($id, $version, Context $context = null)
    {
        return new static($id, $version, $context);
    }
}
