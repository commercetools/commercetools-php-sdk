<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\TaxCategories;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\TaxCategory\TaxCategoryDraft;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\TaxCategories
 * @link https://dev.commercetools.com/http-api-projects-taxCategories.html#create-taxcategory
 * @method TaxCategory mapResponse(ApiResponseInterface $response)
 * @method TaxCategory mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class TaxCategoryCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = TaxCategory::class;

    /**
     * @param TaxCategoryDraft $taxCategory
     * @param Context $context
     */
    public function __construct(TaxCategoryDraft $taxCategory, Context $context = null)
    {
        parent::__construct(TaxCategoriesEndpoint::endpoint(), $taxCategory, $context);
    }

    /**
     * @param TaxCategoryDraft $taxCategory
     * @param Context $context
     * @return static
     */
    public static function ofDraft(TaxCategoryDraft $taxCategory, Context $context = null)
    {
        return new static($taxCategory, $context);
    }
}
