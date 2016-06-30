<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 23.01.15, 16:52
 */

namespace Commercetools\Core\Request\Categories;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Model\Category\CategoryCollection;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\Categories
 * @link https://dev.commercetools.com/http-api-projects-categories.html#query-categories
 * @method CategoryCollection mapResponse(ApiResponseInterface $response)
 */
class CategoryQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = '\Commercetools\Core\Model\Category\CategoryCollection';

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(CategoriesEndpoint::endpoint(), $context);
    }

    /**
     * @param Context $context
     * @return static
     */
    public static function of(Context $context = null)
    {
        return new static($context);
    }
}
