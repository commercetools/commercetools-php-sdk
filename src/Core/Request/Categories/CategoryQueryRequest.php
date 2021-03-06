<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 23.01.15, 16:52
 */

namespace Commercetools\Core\Request\Categories;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Model\Category\CategoryCollection;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Categories
 * @link https://docs.commercetools.com/http-api-projects-categories.html#query-categories
 * @method CategoryCollection mapResponse(ApiResponseInterface $response)
 * @method CategoryCollection mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class CategoryQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = CategoryCollection::class;

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
