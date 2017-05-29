<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Types;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Client\HttpRequest;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractApiRequest;
use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Request\AbstractByKeyGetRequest;
use Commercetools\Core\Request\ExpandTrait;
use Commercetools\Core\Request\PageTrait;
use Commercetools\Core\Request\QueryTrait;
use Commercetools\Core\Request\StagedTrait;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Response\ResourceResponse;
use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Types
 * @method Type mapResponse(ApiResponseInterface $response)
 * @method Type mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class TypeByKeyGetRequest extends AbstractByKeyGetRequest
{
    protected $resultClass = Type::class;

    /**
     * @param string $key
     * @param Context $context
     */
    public function __construct($key, Context $context = null)
    {
        parent::__construct(TypesEndpoint::endpoint(), $key, $context);
    }

    /**
     * @param string $key
     * @param Context $context
     * @return static
     */
    public static function ofKey($key, Context $context = null)
    {
        return new static($key, $context);
    }
}
