<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 02.02.15, 11:26
 */

namespace Commercetools\Core\Request\Products;

use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\Client;
use Commercetools\Core\Model\Common\Collection;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Request\AbstractProjectionRequest;
use Commercetools\Core\Request\PageTrait;
use Commercetools\Core\Response\ResourceResponse;
use Commercetools\Core\Model\Product\SuggestionCollection;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\Products
 * @link http://dev.commercetools.com/http-api-projects-products-search.html#suggest-query
 * @method ResourceResponse executeWithClient(Client $client)
 * @method SuggestionCollection mapResponse(ApiResponseInterface $response)
 */
class ProductsSuggestRequest extends AbstractProjectionRequest
{
    use PageTrait;

    /**
     * @var LocalizedString
     */
    protected $searchKeywords;

    protected $resultClass = '\Commercetools\Core\Model\Product\SuggestionCollection';

    /**
     * @param LocalizedString $keywords
     * @param Context $context
     */
    public function __construct(LocalizedString $keywords = null, Context $context = null)
    {
        parent::__construct(ProductProjectionEndpoint::endpoint(), $context);
        if (!is_null($keywords)) {
            $this->addKeywords($keywords);
        }
    }

    /**
     * @param Context $context
     * @return static
     */
    public static function of(Context $context = null)
    {
        return new static(null, $context);
    }

    /**
     * @param LocalizedString $keywords
     * @param Context $context
     * @return static
     */
    public static function ofKeywords(LocalizedString $keywords, Context $context = null)
    {
        return new static($keywords, $context);
    }

    /**
     * @return string
     */
    protected function getProjectionAction()
    {
        return 'suggest';
    }

    /**
     * @param LocalizedString $localizedString
     * @return $this
     */
    public function addKeywords(LocalizedString $localizedString)
    {
        $this->getSearchKeywords()->merge($localizedString);

        return $this;
    }

    /**
     * @param string $locale
     * @param string $keyword
     * @return $this
     */
    public function addKeyword($locale, $keyword)
    {
        $this->getSearchKeywords()->add($locale, $keyword);

        return $this;
    }

    /**
     * @return LocalizedString
     */
    public function getSearchKeywords()
    {
        if (is_null($this->searchKeywords)) {
            $this->searchKeywords = new LocalizedString([]);
        }
        return $this->searchKeywords;
    }

    /**
     * @param LocalizedString $searchKeywords
     * @return $this
     */
    public function setSearchKeywords(LocalizedString $searchKeywords)
    {
        $this->searchKeywords = $searchKeywords;

        return $this;
    }

    /**
     * @return string
     */
    public function getParamString()
    {
        $params = [];
        foreach ($this->searchKeywords->toArray() as $lang => $keyword) {
            $params[] = 'searchKeywords.' . $lang . '=' . urlencode($keyword);
        }

        $params = array_merge($params, array_keys($this->params));
        sort($params);
        $params = implode('&', $params);

        return (!empty($params) ? '?' . $params : '');
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
     * @return Collection
     */
    public function mapResult(array $result, Context $context = null)
    {
        $data = [];
        if (!empty($result)) {
            $data = $result;
        }
        $object = forward_static_call_array([$this->resultClass, 'fromArray'], [$data, $context]);
        return $object;
    }
}
