<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\State;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\State
 * @link https://dev.commercetools.com/http-api-projects-states.html#state
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
            $id = $row->getId();
            $key = $row->getKey();
        } else {
            $id = isset($row[static::ID]) ? $row[static::ID] : null;
            $key = isset($row[static::KEY]) ? $row[static::KEY] : null;
        }
        $this->addToIndex(static::ID, $offset, $id);
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
