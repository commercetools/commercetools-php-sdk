<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Cart;

use Sphere\Core\Model\Common\Collection;

/**
 * @package Sphere\Core\Model\Cart
 * @method Cart current()
 * @method Cart getAt($offset)
 */
class CartCollection extends Collection
{
    const ID = 'id';
    protected $type = '\Sphere\Core\Model\Cart\Cart';

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
