<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Product
 * @link https://docs.commercetools.com/http-api-projects-productProjections.html#productprojection
 * @method ProductProjection current()
 * @method ProductProjectionCollection add(ProductProjection $element)
 * @method ProductProjection getAt($offset)
 * @method ProductProjection getById($offset)
 */
class ProductProjectionCollection extends Collection
{
    protected $type = ProductProjection::class;

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
