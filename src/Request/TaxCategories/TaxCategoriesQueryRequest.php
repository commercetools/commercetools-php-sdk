<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\TaxCategories;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractQueryRequest;

/**
 * Class TaxCategoriesQueryRequest
 * @package Sphere\Core\Request\TaxCategories
 */
class TaxCategoriesQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = '\Sphere\Core\Model\State\StateCollection';

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(TaxCategoriesEndpoint::endpoint(), $context);
    }
}
