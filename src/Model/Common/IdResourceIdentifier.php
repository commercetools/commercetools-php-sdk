<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 *
 * @method string getTypeId()
 * @method IdResourceIdentifier setTypeId(string $typeId = null)
 * @method string getId()
 * @method IdResourceIdentifier setId(string $id = null)
 */
class IdResourceIdentifier extends ResourceIdentifier
{
    public function fieldDefinitions()
    {
        return [
            'typeId' => [static::TYPE => 'string'],
            'id' => [static::TYPE => 'string']
        ];
    }
}
