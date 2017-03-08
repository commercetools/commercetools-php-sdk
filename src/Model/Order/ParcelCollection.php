<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Order
 * @link https://dev.commercetools.com/http-api-projects-orders.html#parcel
 * @method Parcel current()
 * @method ParcelCollection add(Parcel $element)
 * @method Parcel getAt($offset)
 * @method Parcel getById($offset)
 */
class ParcelCollection extends Collection
{
    protected $type = Parcel::class;

    protected function indexRow($offset, $row)
    {
        $id = null;
        if ($row instanceof Parcel) {
            $id = $row->getId();
        } elseif (is_array($row)) {
            $id = isset($row[static::ID]) ? $row[static::ID] : null;
        }
        $this->addToIndex(static::ID, $offset, $id);
    }
}
