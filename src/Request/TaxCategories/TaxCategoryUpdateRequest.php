<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\TaxCategories;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractUpdateRequest;
use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\TaxCategories
 * @link https://dev.commercetools.com/http-api-projects-taxCategories.html#update-taxcategory
 * @method TaxCategory mapResponse(ApiResponseInterface $response)
 */
class TaxCategoryUpdateRequest extends AbstractUpdateRequest
{
    protected $resultClass = '\Commercetools\Core\Model\TaxCategory\TaxCategory';

    /**
     * @param string $id
     * @param string $version
     * @param array $actions
     * @param Context $context
     */
    public function __construct($id, $version, array $actions = [], Context $context = null)
    {
        parent::__construct(TaxCategoriesEndpoint::endpoint(), $id, $version, $actions, $context);
    }

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofIdAndVersion($id, $version, Context $context = null)
    {
        return new static($id, $version, [], $context);
    }
}
