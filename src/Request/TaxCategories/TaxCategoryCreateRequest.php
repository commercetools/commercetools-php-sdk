<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\TaxCategories;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\TaxCategory\TaxCategoryDraft;
use Sphere\Core\Request\AbstractCreateRequest;

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
}
