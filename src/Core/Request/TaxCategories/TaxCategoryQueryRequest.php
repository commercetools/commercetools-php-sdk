<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\TaxCategories;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Model\TaxCategory\TaxCategoryCollection;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\TaxCategories
 * @link https://docs.commercetools.com/http-api-projects-taxCategories.html#query-taxcategories
 * @method TaxCategoryCollection mapResponse(ApiResponseInterface $response)
 * @method TaxCategoryCollection mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class TaxCategoryQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = TaxCategoryCollection::class;

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(TaxCategoriesEndpoint::endpoint(), $context);
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
