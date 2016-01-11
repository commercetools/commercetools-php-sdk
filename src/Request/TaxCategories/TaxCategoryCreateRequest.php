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

/**
 * @package Commercetools\Core\Request\TaxCategories
 *
 * @method TaxCategory mapResponse(ApiResponseInterface $response)
 */
class TaxCategoryCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Commercetools\Core\Model\TaxCategory\TaxCategory';

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
