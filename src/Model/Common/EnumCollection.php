<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 * @link https://dev.commercetools.com/http-api-projects-products.html#attribute
 * @link https://dev.commercetools.com/http-api-projects-productTypes.html#plainenumvalue
 * @method Enum current()
 * @method EnumCollection add(Enum $element)
 * @method Enum getAt($offset)
 */
class EnumCollection extends Collection
{
    const KEY = 'key';

    protected $type = '\Commercetools\Core\Model\Common\Enum';

    protected function indexRow($offset, $row)
    {
        if ($row instanceof Enum) {
            $key = $row->getKey();
        } else {
            $key = $row[static::KEY];
        }
        $this->addToIndex(static::KEY, $offset, $key);
    }

    /**
     * @param $key
     * @return static
     */
    public function getByKey($key)
    {
        return $this->getBy(static::KEY, $key);
    }
}
