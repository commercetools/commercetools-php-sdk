<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products;

use Psr\Http\Message\ResponseInterface;
use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Client\HttpRequest;
use Sphere\Core\Error\InvalidArgumentException;
use Sphere\Core\Error\Message;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Product\ProductProjection;
use Sphere\Core\Request\AbstractApiRequest;
use Sphere\Core\Request\ExpandTrait;
use Sphere\Core\Request\PageTrait;
use Sphere\Core\Request\QueryTrait;
use Sphere\Core\Request\StagedTrait;
use Sphere\Core\Response\SingleResourceResponse;
use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * Class ProductProjectionFetchBySlugRequest
 * @package Sphere\Core\Request\Products
 * @method ProductProjection mapResponse(ApiResponseInterface $response)
 */
class ProductProjectionFetchBySlugRequest extends AbstractApiRequest
{
    const UUID_FORMAT = '/[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}/i';

    protected $resultClass = '\Sphere\Core\Model\Product\ProductProjection';

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
     * @return SingleResourceResponse
     */
    public function buildResponse(ResponseInterface $response)
    {
        return new SingleResourceResponse($response, $this, $this->getContext());
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
