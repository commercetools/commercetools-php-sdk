<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\TaxCategories;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractByIdGetRequest;
use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\TaxCategories
 * @link https://dev.commercetools.com/http-api-projects-taxCategories.html#get-taxcategory-by-id
 * @method TaxCategory mapResponse(ApiResponseInterface $response)
 * @method TaxCategory mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class TaxCategoryByIdGetRequest extends AbstractByIdGetRequest
{
    protected $resultClass = TaxCategory::class;

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(TaxCategoriesEndpoint::endpoint(), $id, $context);
    }

    /**
     * @param string $id
     * @param Context $context
     * @return static
     */
    public static function ofId($id, Context $context = null)
    {
        return new static($id, $context);
    }
}
