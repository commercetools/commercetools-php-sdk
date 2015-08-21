<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CustomField;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Type\FieldDefinition;
use Commercetools\Core\Model\Type\FieldDefinitionCollection;
use Commercetools\Core\Model\Type\FieldType;
use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Model\Type\TypeReference;

/**
 * @package Commercetools\Core\Model\CustomField
 */
class FieldContainer extends JsonObject
{
    public function fieldDefinition($field)
    {
        if (!$this->parent instanceof CustomFieldObject) {
            return null;
        }
        $typeReference = $this->parent->getType();

        if (!$typeReference instanceof TypeReference) {
            return null;
        }
        $type = $typeReference->getObj();
        if (!$type instanceof Type) {
            return null;
        }
        $fieldDefinitions = $type->getFieldDefinitions();
        if (!$fieldDefinitions instanceof FieldDefinitionCollection) {
            return null;
        }
        $fieldDefinition = $fieldDefinitions->getByName($field);
        if (!$fieldDefinition instanceof FieldDefinition) {
            return null;
        }
        $fieldType = $fieldDefinition->getType();
        if (!$fieldType instanceof FieldType) {
            return null;
        }
        $bla = $fieldType->fieldTypeDefinition();
        return $fieldType->fieldTypeDefinition();
    }

    public function hasField($field)
    {
        return true;
    }
}
