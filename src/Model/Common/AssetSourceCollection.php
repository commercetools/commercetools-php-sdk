<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 *
 * @method AssetSourceCollection add(AssetSource $element)
 * @method AssetSource current()
 * @method AssetSource getAt($offset)
 */
class AssetSourceCollection extends Collection
{
    const KEY = 'key';

    protected $type = '\Commercetools\Core\Model\Common\AssetSource';

    protected function indexRow($offset, $row)
    {
        if ($row instanceof AssetSource) {
            $key = $row->getKey();
        } else {
            $key = $row[static::KEY];
        }
        $this->addToIndex(static::KEY, $offset, $key);
    }

    /**
     * @param string $key
     * @return AssetSource|null
     */
    public function getByKey($key)
    {
        return $this->getBy(static::KEY, $key);
    }
}
