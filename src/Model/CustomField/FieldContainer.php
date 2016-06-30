<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
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
 * @link https://dev.commercetools.com/http-api-projects-custom-fields.html#customfields
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
        return $fieldType->fieldTypeDefinition();
    }

    /**
     * @param string $field
     * @param mixed $value
     * @return $this
     */
    public function set($field, $value)
    {
        return parent::set($field, $value);
    }

    protected function isValidField($field)
    {
        return true;
    }
}
