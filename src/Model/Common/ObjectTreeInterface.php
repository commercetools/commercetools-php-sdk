<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

interface ObjectTreeInterface
{
    /**
     * set the parent of the object, has to be set on instantiation
     * @param $parent
     * @return static
     */
    public function parentSet($parent);

    /**
     * sets the root of the object hierarchy, has to be set on instantiation
     * @param $parent
     * @return static
     */
    public function rootSet($parent);

    /**
     * returns the root of the object hierarchy
     * if no root is given returns the object itself
     * @return object
     */
    public function rootGet();
}
