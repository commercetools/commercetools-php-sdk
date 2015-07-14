<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\TaxCategories;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\TaxCategory\TaxCategoryDraft;
use Sphere\Core\Request\AbstractCreateRequest;
use Sphere\Core\Model\TaxCategory\TaxCategory;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * Class TaxCategoryCreateRequest
 * @package Sphere\Core\Request\TaxCategories
 * 
 * @method TaxCategory mapResponse(ApiResponseInterface $response)
 */
class TaxCategoryCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Sphere\Core\Model\TaxCategory\TaxCategory';

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
