<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CustomObject;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\CustomObject
 *
 * @method CustomObject current()
 * @method CustomObject getAt($offset)
 */
class CustomObjectCollection extends Collection
{
    const KEY = 'key';
    const CONTAINER = 'container';

    protected $type = '\Commercetools\Core\Model\CustomObject\CustomObject';

    /**
     * @param $offset
     * @param $row
     */
    protected function indexRow($offset, $row)
    {
        if ($row instanceof CustomObject) {
            $key = $row->getKey();
            $container = $row->getContainer();
        } else {
            $key = $row[static::KEY];
            $container = $row[static::CONTAINER];
        }
        $this->addToIndex(static::KEY, $offset, $key);
        $this->addToIndex(static::CONTAINER . '-' . static::KEY, $offset, $container . '-' . $key);
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function getByKey($key)
    {
        return $this->getBy(static::KEY, $key);
    }

    /**
     * @param $container
     * @param $key
     * @return mixed|null
     */
    public function getByContainerKey($container, $key)
    {
        return $this->getBy(static::CONTAINER . '-' . static::KEY, $container . '-' . $key);
    }
}
