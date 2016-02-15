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
use Commercetools\Core\Request\ExpandTrait;
use Commercetools\Core\Request\PageTrait;
use Commercetools\Core\Request\QueryTrait;
use Commercetools\Core\Request\StagedTrait;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Response\ResourceResponse;
use Psr\Http\Message\ResponseInterface;

/**
 * @package Commercetools\Core\Request\Types
 * @method Type mapResponse(ApiResponseInterface $response)
 */
class TypeByKeyGetRequest extends AbstractApiRequest
{
    protected $resultClass = '\Commercetools\Core\Model\Type\Type';

    use QueryTrait;
    use StagedTrait;
    use PageTrait;
    use ExpandTrait;

    /**
     * @param string $key
     * @param Context $context
     */
    public function __construct($key, Context $context = null)
    {
        parent::__construct(TypesEndpoint::endpoint(), $context);
        if (!is_null($key)) {
            $this->where(sprintf('key="%1$s"', $key));
        }
        $this->limit(1);
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

    /**
     * @return HttpRequest
     * @internal
     */
    public function httpRequest()
    {
        return new HttpRequest(HttpMethod::GET, $this->getPath());
    }

    /**
     * @param ResponseInterface $response
     * @return ResourceResponse
     */
    public function buildResponse(ResponseInterface $response)
    {
        return new ResourceResponse($response, $this, $this->getContext());
    }

    /**
     * @param array $result
     * @param Context $context
     * @return Type|null
     */
    public function mapResult(array $result, Context $context = null)
    {
        if (!empty($result['results'])) {
            $data = current($result['results']);
            return Type::fromArray($data, $context);
        }
        return null;
    }
}
