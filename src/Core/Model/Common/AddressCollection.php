<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 * @link https://dev.commercetools.com/http-api-types.html#address
 * @method Address current()
 * @method AddressCollection add(Address $element)
 * @method Address getAt($offset)
 * @method Address getById($offset)
 */
class AddressCollection extends Collection
{
    protected $type = Address::class;

    protected function indexRow($offset, $row)
    {
        if ($row instanceof Address) {
            $name = $row->getId();
        } else {
            $name = $row[static::ID];
        }
        $this->addToIndex(static::ID, $offset, $name);
    }
}
