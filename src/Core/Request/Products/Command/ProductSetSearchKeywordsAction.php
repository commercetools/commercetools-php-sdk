<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Product\LocalizedSearchKeywords;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @link https://docs.commercetools.com/http-api-projects-products.html#set-searchkeywords
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
            'searchKeywords' => [static::TYPE => LocalizedSearchKeywords::class],
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
