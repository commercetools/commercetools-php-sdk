<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Product;


use Sphere\Core\Model\Common\Collection;

class SearchKeywords extends Collection
{
    protected $type = '\Sphere\Core\Model\Product\SearchKeyword';

    /**
     * @return string
     */
    public function __toString()
    {
        $text = [];
        foreach ($this as $keyword) {
            $text[] = (string)$keyword;
        }
        return implode(', ', $text);
    }
}
