<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 02.02.15, 11:26
 */

namespace Sphere\Core\Request\Products;

use Psr\Http\Message\ResponseInterface;
use Sphere\Core\Model\Common\Collection;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Request\AbstractProjectionRequest;
use Sphere\Core\Request\PageTrait;
use Sphere\Core\Response\SingleResourceResponse;

/**
 * Class ProductsSearchRequest
 * @package Sphere\Core\Request\Products
 * @link http://dev.sphere.io/http-api-projects-products-search.html#suggest-query
 * @method static ProductsSuggestRequest of(LocalizedString $keywords)
 */
class ProductsSuggestRequest extends AbstractProjectionRequest
{
    use PageTrait;

    /**
     * @var LocalizedString
     */
    protected $searchKeywords;

    protected $resultClass = '\Sphere\Core\Model\Product\SuggestionCollection';

    /**
     * @param LocalizedString $keywords
     * @param Context $context
     */
    public function __construct(LocalizedString $keywords = null, Context $context = null)
    {
        parent::__construct(ProductSearchEndpoint::endpoint(), $context);
        if (!is_null($keywords)) {
            $this->addKeywords($keywords);
        }
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
     * @return SingleResourceResponse
     */
    public function buildResponse(ResponseInterface $response)
    {
        return new SingleResourceResponse($response, $this, $this->getContext());
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
