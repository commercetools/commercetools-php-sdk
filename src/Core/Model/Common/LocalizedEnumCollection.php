<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 * @link https://docs.commercetools.com/http-api-projects-products.html#attribute
 * @link https://docs.commercetools.com/http-api-projects-productTypes.html#localizedenumvalue
 * @method LocalizedEnum current()
 * @method LocalizedEnumCollection add(LocalizedEnum $element)
 * @method LocalizedEnum getAt($offset)
 */
class LocalizedEnumCollection extends Collection
{
    const KEY = 'key';

    protected $type = LocalizedEnum::class;

    protected function indexRow($offset, $row)
    {
        if ($row instanceof LocalizedEnum) {
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
