<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\TaxCategories;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractByIdGetRequest;
use Sphere\Core\Model\TaxCategory\TaxCategory;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * @package Sphere\Core\Request\TaxCategories
 * @link http://dev.sphere.io/http-api-projects-taxCategories.html#tax-category-by-id
 * @method TaxCategory mapResponse(ApiResponseInterface $response)
 */
class TaxCategoryByIdGetRequest extends AbstractByIdGetRequest
{
    protected $resultClass = '\Sphere\Core\Model\TaxCategory\TaxCategory';

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
