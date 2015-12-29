<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Type;

/**
 * @package Commercetools\Core\Model\Type
 * @method string getName()
 * @method ReferenceType setName(string $name = null)
 * @method string getReferenceTypeId()
 * @method ReferenceType setReferenceTypeId(string $referenceTypeId = null)
 */
class ReferenceType extends FieldType
{
    const NAME = 'Reference';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['referenceTypeId'] = [static::TYPE => 'string'];

        return $definitions;
    }

    public function fieldTypeDefinition()
    {
        return [static::TYPE => '\Commercetools\Core\Model\Common\Reference'];
    }
}
