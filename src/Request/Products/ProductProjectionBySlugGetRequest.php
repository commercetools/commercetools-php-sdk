<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products;

use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Client\HttpRequest;
use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Error\Message;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Product\ProductProjection;
use Commercetools\Core\Request\AbstractApiRequest;
use Commercetools\Core\Request\ExpandTrait;
use Commercetools\Core\Request\PageTrait;
use Commercetools\Core\Request\QueryTrait;
use Commercetools\Core\Request\StagedTrait;
use Commercetools\Core\Response\ResourceResponse;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\Products
 * @method ProductProjection mapResponse(ApiResponseInterface $response)
 */
class ProductProjectionBySlugGetRequest extends AbstractApiRequest
{
    const UUID_FORMAT = '/[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}/i';

    protected $resultClass = '\Commercetools\Core\Model\Product\ProductProjection';

    use QueryTrait;
    use StagedTrait;
    use PageTrait;
    use ExpandTrait;

    /**
     * @param string $slug
     * @param Context $context
     */
    public function __construct($slug, Context $context)
    {
        parent::__construct(ProductProjectionEndpoint::endpoint(), $context);
        if (count($context->getLanguages()) == 0) {
            throw new InvalidArgumentException(Message::NO_LANGUAGES_PROVIDED);
        }
        $parts = array_map(
            function ($value) {
                return sprintf('slug(%s="%s")', $value, '%1$s');
            },
            $context->getLanguages()
        );
        if (preg_match(static::UUID_FORMAT, $slug)) {
            $parts[] = 'id="%1$s"';
        }
        if (!empty($parts)) {
            $this->where(sprintf(implode(' or ', $parts), $slug));
        }
        $this->limit(1);
    }

    /**
     * @param string $slug
     * @param Context $context
     * @return static
     */
    public static function ofSlugAndContext($slug, Context $context)
    {
        return new static($slug, $context);
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
     * @return ProductProjection|null
     */
    public function mapResult(array $result, Context $context = null)
    {
        if (!empty($result['results'])) {
            $data = current($result['results']);
            return ProductProjection::fromArray($data, $context);
        }
        return null;
    }
}
