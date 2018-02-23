<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\TaxCategories;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractDeleteByKeyRequest;
use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\TaxCategories
 * @link https://docs.commercetools.com/http-api-projects-taxCategories.html#delete-taxcategory
 * @method TaxCategory mapResponse(ApiResponseInterface $response)
 * @method TaxCategory mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class TaxCategoryDeleteByKeyRequest extends AbstractDeleteByKeyRequest
{
    protected $resultClass = TaxCategory::class;

    /**
     * @param string $key
     * @param int $version
     * @param Context $context
     */
    public function __construct($key, $version, Context $context = null)
    {
        parent::__construct(TaxCategoriesEndpoint::endpoint(), $key, $version, $context);
    }

    /**
     * @param string $key
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofKeyAndVersion($key, $version, Context $context = null)
    {
        return new static($key, $version, $context);
    }
}
