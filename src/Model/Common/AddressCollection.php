<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 * @method Address current()
 * @method AddressCollection add(Address $element)
 * @method Address getAt($offset)
 */
class AddressCollection extends Collection
{
    const ID = 'id';

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

    /**
     * @param $id
     * @return Address|null
     */
    public function getById($id = null)
    {
        return $this->getBy(static::ID, $id);
    }
}
