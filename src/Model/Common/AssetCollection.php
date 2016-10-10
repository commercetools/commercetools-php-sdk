<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 *
 * @method AssetCollection add(Asset $element)
 * @method Asset current()
 * @method Asset getAt($offset)
 * @method Asset getById($offset)
 */
class AssetCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Common\Asset';

    protected function indexRow($offset, $row)
    {
        $id = null;
        if ($row instanceof Asset) {
            $id = $row->getId();
        } elseif (is_array($row)) {
            $id = isset($row[static::ID]) ? $row[static::ID] : null;
        }
        $this->addToIndex(static::ID, $offset, $id);
    }
}
