<?php
/**
 */

namespace Commercetools\Core\Request\ApiClients;

use Commercetools\Core\Model\ApiClient\ApiClient;
use Commercetools\Core\Model\ApiClient\ApiClientDraft;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\ApiClients
 * @method ApiClient mapResponse(ApiResponseInterface $response)
 * @method ApiClient mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ApiClientCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = ApiClient::class;

    /**
     * @param ApiClientDraft $apiClientDraft
     * @param Context $context
     */
    public function __construct(ApiClientDraft $apiClientDraft, Context $context = null)
    {
        parent::__construct(ApiClientsEndpoint::endpoint(), $apiClientDraft, $context);
    }

    /**
     * @param ApiClientDraft $apiClientDraft
     * @param Context $context
     * @return static
     */
    public static function ofDraft(ApiClientDraft $apiClientDraft, Context $context = null)
    {
        return new static($apiClientDraft, $context);
    }
}
