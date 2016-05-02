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
 */
class AddressCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Common\Address';

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
