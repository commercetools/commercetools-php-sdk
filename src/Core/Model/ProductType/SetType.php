<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

use Commercetools\Core\Model\Common\Set;

/**
 * @package Commercetools\Core\Model\ProductType
 * @link https://docs.commercetools.com/http-api-projects-productTypes.html#settype
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
        $definitions['elementType'] = [static::TYPE => AttributeType::class];

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
            static::TYPE => Set::class,
            static::ELEMENT_TYPE => $elementType
        ];
    }
}
