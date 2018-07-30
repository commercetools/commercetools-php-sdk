<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 * @link https://docs.commercetools.com/http-api-types.html#address
 * @method Address current()
 * @method AddressCollection add(Address $element)
 * @method Address getAt($offset)
 * @method Address getById($offset)
 */
class AddressCollection extends Collection
{
    const KEY = 'key';

    protected $type = Address::class;

    protected function indexRow($offset, $row)
    {
        $id = null;
        $key = null;
        if ($row instanceof Address) {
            $id = $row->getId();
            $key = $row->getKey();
        } elseif (is_array($row)) {
            $id = isset($row[static::ID]) ? $row[static::ID] : null;
            $key = isset($row[static::KEY]) ? $row[static::KEY] : null;
        }
        $this->addToIndex(static::ID, $offset, $id);
        $this->addToIndex(static::KEY, $offset, $key);
    }

    /**
     * @param $key
     * @return Address|null
     */
    public function getByKey($key)
    {
        return $this->getBy(static::KEY, $key);
    }
}
