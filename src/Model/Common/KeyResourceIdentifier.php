<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
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
     * @return array
     * @internal
     */
    public function fieldDefinitions()
    {
        return [
            'typeId' => [static::TYPE => 'string'],
            'key' => [static::TYPE => 'string']
        ];
    }
}
