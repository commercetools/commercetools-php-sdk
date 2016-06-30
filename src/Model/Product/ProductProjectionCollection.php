<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Product
 * @link https://dev.commercetools.com/http-api-projects-productProjections.html#productprojection
 * @method ProductProjection current()
 * @method ProductProjectionCollection add(ProductProjection $element)
 * @method ProductProjection getAt($offset)
 */
class ProductProjectionCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Product\ProductProjection';

    protected function indexRow($offset, $row)
    {
        if ($row instanceof ProductProjection) {
            $id = $row->getId();
        } else {
            $id = isset($row[static::ID]) ? $row[static::ID]: null;
        }
        $this->addToIndex(static::ID, $offset, $id);
    }
}
