<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 * @link https://docs.commercetools.com/http-api-projects-products.html#price
 * @method Price current()
 * @method PriceCollection add(Price $element)
 * @method Price getAt($offset)
 * @method Price getById($offset)
 */
class PriceCollection extends Collection
{
    protected $type = Price::class;

    protected function indexRow($offset, $row)
    {
        $id = null;
        if ($row instanceof Price) {
            $id = $row->getId();
        } elseif (is_array($row)) {
            $id = isset($row[static::ID]) ? $row[static::ID] : null;
        }
        $this->addToIndex(static::ID, $offset, $id);
    }
}
