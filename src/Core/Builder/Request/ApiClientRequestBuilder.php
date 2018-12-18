<?php
// phpcs:disable Generic.Files.LineLength
namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\ApiClients\ApiClientByIdGetRequest;
use Commercetools\Core\Request\ApiClients\ApiClientCreateRequest;
use Commercetools\Core\Model\ApiClient\ApiClientDraft;
use Commercetools\Core\Request\ApiClients\ApiClientDeleteRequest;
use Commercetools\Core\Model\ApiClient\ApiClient;
use Commercetools\Core\Request\ApiClients\ApiClientQueryRequest;

class ApiClientRequestBuilder
{

    /**
     *
     * @param string $id
     * @return ApiClientByIdGetRequest
     */
    public function getById($id)
    {
        $request = ApiClientByIdGetRequest::ofId($id);
        return $request;
    }

    /**
     *
     * @param ApiClientDraft $apiClientDraft
     * @return ApiClientCreateRequest
     */
    public function create(ApiClientDraft $apiClientDraft)
    {
        $request = ApiClientCreateRequest::ofDraft($apiClientDraft);
        return $request;
    }

    /**
     *
     * @param ApiClient $apiClient
     * @return ApiClientDeleteRequest
     */
    public function delete(ApiClient $apiClient)
    {
        $request = ApiClientDeleteRequest::ofId($apiClient->getId());
        return $request;
    }

    /**
     *
     *
     * @return ApiClientQueryRequest
     */
    public function query()
    {
        $request = ApiClientQueryRequest::of();
        return $request;
    }

    /**
     * @return ApiClientRequestBuilder
     */
    public function of()
    {
        return new self();
    }
}
