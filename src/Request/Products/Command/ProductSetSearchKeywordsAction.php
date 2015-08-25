<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Product\LocalizedSearchKeywords;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @apidoc http://dev.sphere.io/http-api-projects-products.html#set-search-keywords
 * @method string getAction()
 * @method ProductSetSearchKeywordsAction setAction(string $action = null)
 * @method LocalizedSearchKeywords getSearchKeywords()
 * @method ProductSetSearchKeywordsAction setSearchKeywords(LocalizedSearchKeywords $searchKeywords = null)
 * @method bool getStaged()
 * @method ProductSetSearchKeywordsAction setStaged(bool $staged = null)
 */
class ProductSetSearchKeywordsAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'searchKeywords' => [static::TYPE => '\Commercetools\Core\Model\Product\LocalizedSearchKeywords'],
            'staged' => [static::TYPE => 'bool'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setSearchKeywords');
    }

    /**
     * @param LocalizedSearchKeywords $keywords
     * @param Context|callable $context
     * @return ProductSetSearchKeywordsAction
     */
    public static function ofKeywords(LocalizedSearchKeywords $keywords, $context = null)
    {
        return static::of($context)->setSearchKeywords($keywords);
    }
}
