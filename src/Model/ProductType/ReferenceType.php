<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

/**
 * @package Commercetools\Core\Model\ProductType
 * @link https://dev.commercetools.com/http-api-projects-productTypes.html#reference-type
 * @method string getName()
 * @method ReferenceType setName(string $name = null)
 * @method string getReferenceTypeId()
 * @method ReferenceType setReferenceTypeId(string $referenceTypeId = null)
 */
class ReferenceType extends AttributeType
{
    const NAME = 'reference';

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
