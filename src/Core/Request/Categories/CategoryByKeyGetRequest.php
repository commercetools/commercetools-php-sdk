<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 26.01.15, 14:56
 */

namespace Commercetools\Core\Request\Categories;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Category\Category;
use Commercetools\Core\Request\AbstractByKeyGetRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Categories
 * @link https://docs.commercetools.com/http-api-projects-categories.html#get-category-by-key
 * @method Category mapResponse(ApiResponseInterface $response)
 * @method Category mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class CategoryByKeyGetRequest extends AbstractByKeyGetRequest
{
    protected $resultClass = Category::class;

    /**
     * @param string $key
     * @param Context $context
     */
    public function __construct($key, Context $context = null)
    {
        parent::__construct(CategoriesEndpoint::endpoint(), $key, $context);
    }

    /**
     * @param string $key
     * @param Context $context
     * @return static
     */
    public static function ofKey($key, Context $context = null)
    {
        return new static($key, $context);
    }
}
