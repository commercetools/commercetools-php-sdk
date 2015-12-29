<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Type;

/**
 * @package Commercetools\Core\Model\Type
 * @method string getName()
 * @method SetType setName(string $name = null)
 * @method FieldType getElementType()
 * @method SetType setElementType(FieldType $elementType = null)
 */
class SetType extends FieldType
{
    const NAME = 'Set';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['elementType'] = [static::TYPE => '\Commercetools\Core\Model\Type\FieldType'];

        return $definitions;
    }

    public function fieldTypeDefinition()
    {
        $elementType = '';
        if ($this->getElementType() instanceof FieldType) {
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
