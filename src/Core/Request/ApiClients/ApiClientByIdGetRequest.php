<?php
/**
 */

namespace Commercetools\Core\Request\ApiClients;

use Commercetools\Core\Model\ApiClient\ApiClient;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractByIdGetRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\ApiClients
 * @method ApiClient mapResponse(ApiResponseInterface $response)
 * @method ApiClient mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ApiClientByIdGetRequest extends AbstractByIdGetRequest
{
    protected $resultClass = ApiClient::class;

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(ApiClientsEndpoint::endpoint(), $id, $context);
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
