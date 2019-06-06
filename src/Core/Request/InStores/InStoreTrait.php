<?php
/**
 */

namespace Commercetools\Core\Request\InStores;

trait InStoreTrait
{
    /**
     * @param $storeKey
     * @return InStoreRequestDecorator
     */
    public function inStore($storeKey)
    {
        return new InStoreRequestDecorator($storeKey, $this);
    }
}
