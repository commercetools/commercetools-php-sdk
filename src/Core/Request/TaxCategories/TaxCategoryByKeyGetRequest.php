<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\TaxCategories;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Request\AbstractByKeyGetRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\TaxCategories
 * @method TaxCategory mapResponse(ApiResponseInterface $response)
 * @method TaxCategory mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class TaxCategoryByKeyGetRequest extends AbstractByKeyGetRequest
{
    protected $resultClass = TaxCategory::class;

    /**
     * @param string $key
     * @param Context $context
     */
    public function __construct($key, Context $context = null)
    {
        parent::__construct(TaxCategoriesEndpoint::endpoint(), $key, $context);
    }

    /**
     * @param string $key
     * @param Context $context
     * @return TaxCategoryByKeyGetRequest
     */
    public static function ofKey($key, Context $context = null)
    {
        return new static($key, $context);
    }
}
