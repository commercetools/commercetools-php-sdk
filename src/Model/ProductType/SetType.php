<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

/**
 * @package Commercetools\Core\Model\ProductType
 * @method string getName()
 * @method SetType setName(string $name = null)
 * @method AttributeType getElementType()
 * @method SetType setElementType(AttributeType $elementType = null)
 */
class SetType extends AttributeType
{
    const NAME = 'set';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['elementType'] = [static::TYPE => '\Commercetools\Core\Model\ProductType\AttributeType'];

        return $definitions;
    }

    public function fieldTypeDefinition()
    {
        $elementType = '';
        if ($this->getElementType() instanceof AttributeType) {
            $definition = $this->getElementType()->fieldTypeDefinition();
            if (isset($definition[static::TYPE])) {
                $elementType = $definition[static::TYPE];
            }
        }
        return [
            static::TYPE => '\Commercetools\Core\Model\Common\Set',
            static::ELEMENT_TYPE => $elementType
        ];
    }
}
