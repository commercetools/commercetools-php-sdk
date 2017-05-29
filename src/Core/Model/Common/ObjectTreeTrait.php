<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

trait ObjectTreeTrait
{
    protected $parent;
    protected $root;

    public function rootGet()
    {
        if (is_null($this->root)) {
            return $this;
        }
        return $this->root;
    }

    /**
     * @param $parent
     * @return $this
     */
    public function parentSet($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @param $root
     * @return $this
     */
    public function rootSet($root)
    {
        $this->root = $root;

        return $this;
    }
}
