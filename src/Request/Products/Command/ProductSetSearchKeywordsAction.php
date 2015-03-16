<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products\Command;


use Sphere\Core\Model\Product\LocalizedSearchKeywords;
use Sphere\Core\Request\AbstractAction;

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
     * @param LocalizedSearchKeywords $keywords
     */
    public function __construct(LocalizedSearchKeywords $keywords)
    {
        $this->setAction('setSearchKeywords');
        $this->setSearchKeywords($keywords);
    }
}
