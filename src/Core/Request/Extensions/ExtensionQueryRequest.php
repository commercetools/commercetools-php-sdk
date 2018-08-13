<?php
/**
 */

namespace Commercetools\Core\Request\Extensions;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Extension\ExtensionCollection;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Extensions
 * @link https://docs.commercetools.com/http-api-projects-api-extensions.html#query-extensions
 * @method ExtensionCollection mapResponse(ApiResponseInterface $response)
 * @method ExtensionCollection mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ExtensionQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = ExtensionCollection::class;

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(ExtensionsEndpoint::endpoint(), $context);
    }

    /**
     * @param Context $context
     * @return static
     */
    public static function of(Context $context = null)
    {
        return new static($context);
    }
}
