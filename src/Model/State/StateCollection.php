<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\State;

use Sphere\Core\Model\Common\Collection;

/**
 * Class StateCollection
 * @package Sphere\Core\Model\State
 * @method State current()
 * @method State getAt($offset)
 */
class StateCollection extends Collection
{
    const KEY = 'key';

    protected $type = '\Sphere\Core\Model\State\State';

    protected function indexRow($offset, $row)
    {
        if ($row instanceof State) {
            $key = $row->getKey();
        } else {
            $key = $row[static::KEY];
        }
        $this->addToIndex(static::KEY, $offset, $key);
    }

    /**
     * @param $key
     * @return State
     */
    public function getByKey($key)
    {
        return $this->getBy(static::KEY, $key);
    }
}
