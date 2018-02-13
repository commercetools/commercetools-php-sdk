<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\ProductType
 * @link https://docs.commercetools.com/http-api-projects-productTypes.html#referencetype
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
        return [static::TYPE => Reference::class];
    }
}
