<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Type;

use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\Type
 * @link https://docs.commercetools.com/http-api-projects-types.html#referencetype
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
        return [static::TYPE => Reference::class];
    }
}
