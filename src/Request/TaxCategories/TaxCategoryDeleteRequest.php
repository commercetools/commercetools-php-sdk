<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\TaxCategories;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractDeleteRequest;
use Sphere\Core\Model\TaxCategory\TaxCategory;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * @package Sphere\Core\Request\TaxCategories
 * @apidoc http://dev.sphere.io/http-api-projects-taxCategories.html#delete-tax-category
 * @method TaxCategory mapResponse(ApiResponseInterface $response)
 */
class TaxCategoryDeleteRequest extends AbstractDeleteRequest
{
    protected $resultClass = '\Sphere\Core\Model\TaxCategory\TaxCategory';

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     */
    public function __construct($id, $version, Context $context = null)
    {
        parent::__construct(TaxCategoriesEndpoint::endpoint(), $id, $version, $context);
    }

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofIdAndVersion($id, $version, Context $context = null)
    {
        return new static($id, $version, $context);
    }
}
