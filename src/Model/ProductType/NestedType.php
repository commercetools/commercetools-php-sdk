<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

/**
 * @package Commercetools\Core\Model\ProductType
 * @link https://dev.commercetools.com/http-api-projects-productTypes.html#nestedtype
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
        $definitions['typeReference'] = [static::TYPE => '\Commercetools\Core\Model\ProductType\ProductTypeReference'];

        return $definitions;
    }

    public function fieldTypeDefinition()
    {
        return [static::TYPE => '\Commercetools\Core\Model\Common\AttributeCollection'];
    }
}
