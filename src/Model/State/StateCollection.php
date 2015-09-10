<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\State;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\State
 * @method State current()
 * @method StateCollection add(State $element)
 * @method State getAt($offset)
 */
class StateCollection extends Collection
{
    const KEY = 'key';

    protected $type = '\Commercetools\Core\Model\State\State';

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
