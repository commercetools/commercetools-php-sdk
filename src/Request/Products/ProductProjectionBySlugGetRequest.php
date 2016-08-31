<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products;

use Commercetools\Core\Request\PriceSelectTrait;
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
    use PriceSelectTrait;

    /**
     * @param string $slug
     * @param Context $context
     * @param array $languages
     */
    public function __construct($slug, Context $context = null, array $languages = [])
    {
        parent::__construct(ProductProjectionEndpoint::endpoint(), $context);
        if (count($languages) == 0 && !is_null($context)) {
            $languages = $context->getLanguages();
        }
        if (count($languages) == 0) {
            throw new InvalidArgumentException(Message::NO_LANGUAGES_PROVIDED);
        }
        $parts = array_map(
            function ($value) {
                return sprintf('slug(%s="%s")', $value, '%1$s');
            },
            $languages
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
        return new static($slug, $context, $context->getLanguages());
    }

    /**
     * @param $slug
     * @param array $languages
     * @param Context $context
     * @return static
     */
    public static function ofSlugAndLanguages($slug, array $languages, Context $context = null)
    {
        return new static($slug, $context, $languages);
    }

    /**
     * @param $slug
     * @param string $language
     * @param Context $context
     * @return static
     */
    public static function ofSlugAndLanguage($slug, $language, Context $context = null)
    {
        if (!is_string($language)) {
            throw new InvalidArgumentException(
                sprintf(Message::WRONG_ARGUMENT_TYPE, 'language', 'string')
            );
        }
        return new static($slug, $context, [$language]);
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
