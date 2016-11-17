<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Type;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Type
 * @link https://dev.commercetools.com/http-api-projects-types.html#type
 * @method Type current()
 * @method TypeCollection add(Type $element)
 * @method Type getAt($offset)
 * @method Type getById($offset)
 */
class TypeCollection extends Collection
{
    const KEY = 'key';
    protected $type = '\Commercetools\Core\Model\Type\Type';

    protected function indexRow($offset, $row)
    {
        $id = null;
        $key = null;
        if ($row instanceof Type) {
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
     * @return Type|null
     */
    public function getByKey($key)
    {
        return $this->getBy(static::KEY, $key);
    }
}
