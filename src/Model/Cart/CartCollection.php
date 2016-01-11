<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Cart
 * @method Cart current()
 * @method CartCollection add(Cart $element)
 * @method Cart getAt($offset)
 */
class CartCollection extends Collection
{
    const ID = 'id';
    protected $type = '\Commercetools\Core\Model\Cart\Cart';

    protected function indexRow($offset, $row)
    {
        if ($row instanceof Cart) {
            $id = $row->getId();
        } else {
            $id = $row[static::ID];
        }
        $this->addToIndex(static::ID, $offset, $id);
    }

    /**
     * @param $id
     * @return Cart
     */
    public function getById($id)
    {
        return $this->getBy(static::ID, $id);
    }
}
