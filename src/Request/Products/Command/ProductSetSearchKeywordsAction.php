<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Product\LocalizedSearchKeywords;
use Sphere\Core\Request\AbstractAction;

/**
 * Class ProductSetSearchKeywordsAction
 * @package Sphere\Core\Request\Products\Command
 * @link http://dev.sphere.io/http-api-projects-products.html#set-search-keywords
 * @method string getAction()
 * @method ProductSetSearchKeywordsAction setAction(string $action = null)
 * @method LocalizedSearchKeywords getSearchKeywords()
 * @method ProductSetSearchKeywordsAction setSearchKeywords(LocalizedSearchKeywords $searchKeywords = null)
 * @method bool getStaged()
 * @method ProductSetSearchKeywordsAction setStaged(bool $staged = null)
 */
class ProductSetSearchKeywordsAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'searchKeywords' => [static::TYPE => '\Sphere\Core\Model\Product\LocalizedSearchKeywords'],
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
