<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 02.02.15, 11:26
 */

namespace Sphere\Core\Request\Products;

use Sphere\Core\Model\Type\LocalizedString;
use Sphere\Core\Request\AbstractProjectionRequest;
use Sphere\Core\Request\Endpoints\ProductProjectionsEndpoint;
use Sphere\Core\Response\SingleResourceResponse;

/**
 * Class ProductsSearchRequest
 * @package Sphere\Core\Request\Products
 * @method static ProductsSuggestRequest of(LocalizedString $keywords)
 */
class ProductsSuggestRequest extends AbstractProjectionRequest
{
    /**
     * @var LocalizedString
     */
    protected $searchKeywords;

    /**
     * @param LocalizedString $keywords
     */
    public function __construct(LocalizedString $keywords)
    {
        parent::__construct(ProductProjectionsEndpoint::endpoint());
        $this->addKeywords($keywords);
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
     */
    public function addKeywords(LocalizedString $localizedString)
    {
        $this->getSearchKeywords()->merge($localizedString);
    }

    /**
     * @param string $locale
     * @param string $keyword
     */
    public function addKeyword($locale, $keyword)
    {
        $this->getSearchKeywords()->add($locale, $keyword);
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
     */
    public function setSearchKeywords(LocalizedString $searchKeywords)
    {
        $this->searchKeywords = $searchKeywords;
    }

    public function buildResponse($response)
    {
        return new SingleResourceResponse($response, $this);
    }
}
