<?php
/**
 */

namespace Commercetools\Core\Request\ApiClients;

use Commercetools\Core\Model\ApiClient\ApiClientCollection;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\ApiClients
 * @method ApiClientCollection mapResponse(ApiResponseInterface $response)
 * @method ApiClientCollection mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ApiClientQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = ApiClientCollection::class;

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(ApiClientsEndpoint::endpoint(), $context);
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
