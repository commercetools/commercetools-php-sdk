<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 26.01.15, 18:14
 */

namespace Commercetools\Core\Request\Categories;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractUpdateByKeyRequest;
use Commercetools\Core\Model\Category\Category;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Categories
 * @link https://docs.commercetools.com/http-api-projects-categories.html#update-category
 * @method Category mapResponse(ApiResponseInterface $response)
 * @method Category mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class CategoryUpdateByKeyRequest extends AbstractUpdateByKeyRequest
{
    protected $resultClass = Category::class;

    /**
     * @param string $key
     * @param int $version
     * @param array $actions
     * @param Context $context
     */
    public function __construct($key, $version, array $actions = [], Context $context = null)
    {
        parent::__construct(CategoriesEndpoint::endpoint(), $key, $version, $actions, $context);
    }

    /**
     * @param string $key
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofKeyAndVersion($key, $version, Context $context = null)
    {
        return new static($key, $version, [], $context);
    }
}
