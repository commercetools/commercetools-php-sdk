<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 *
 * @method string getTypeId()
 * @method KeyResourceIdentifier setTypeId(string $typeId = null)
 * @method string getKey()
 * @method KeyResourceIdentifier setKey(string $key = null)
 */
class KeyResourceIdentifier extends ResourceIdentifier
{
    /**
     * @internal
     * @return null
     */
    public function getId()
    {
        return null;
    }

    /**
     * @internal
     * @param null $id
     * @return $this
     */
    public function setId($id = null)
    {
        return $this;
    }
}
