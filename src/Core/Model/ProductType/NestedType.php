<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

use Commercetools\Core\Model\Common\AttributeCollection;

/**
 * @package Commercetools\Core\Model\ProductType
 * @link https://docs.commercetools.com/http-api-projects-productTypes.html#nestedtype
 * @method string getName()
 * @method NestedType setName(string $name = null)
 * @method ProductTypeReference getTypeReference()
 * @method NestedType setTypeReference(ProductTypeReference $typeReference = null)
 */
class NestedType extends AttributeType
{
    const NAME = 'nested';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['typeReference'] = [static::TYPE => ProductTypeReference::class];

        return $definitions;
    }

    public function fieldTypeDefinition()
    {
        return [static::TYPE => AttributeCollection::class];
    }
}
