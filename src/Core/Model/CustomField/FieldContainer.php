<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CustomField;

use Commercetools\Core\Model\Common\DateDecorator;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Enum;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedEnum;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Common\Set;
use Commercetools\Core\Model\Common\TimeDecorator;
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

    /**
     * @return bool
     */
    public function getFieldAsBool($name)
    {
        return (bool)$this->get($name);
    }

    /**
     * @return float
     */
    public function getFieldAsNumber($name)
    {
        $value = $this->get($name);
        return (float)$value;
    }

    /**
     * @return int
     */
    public function getFieldAsInteger($name)
    {
        $value = $this->get($name);
        return (int)$value;
    }

    /**
     * @return string
     */
    public function getFieldAsString($name)
    {
        return (string)$this->get($name);
    }

    /**
     * @return LocalizedString
     */
    public function getFieldAsLocalizedString($name)
    {
        return $this->getFieldAsType($name, LocalizedString::class);
    }

    /**
     * @return LocalizedEnum
     */
    public function getFieldAsLocalizedEnum($name)
    {
        return $this->getFieldAsType($name, LocalizedEnum::class);
    }

    /**
     * @return Enum
     */
    public function getFieldAsEnum($name)
    {
        return $this->getFieldAsType($name, Enum::class);
    }

    /**
     * @return Money
     */
    public function getFieldAsMoney($name)
    {
        return $this->getFieldAsType($name, Money::class);
    }

    /**
     * @return DateDecorator
     */
    public function getFieldAsDate($name)
    {
        return $this->getFieldAsType($name, DateDecorator::class);
    }

    /**
     * @return TimeDecorator
     */
    public function getFieldAsTime($name)
    {
        return $this->getFieldAsType($name, TimeDecorator::class);
    }

    /**
     * @return DateTimeDecorator
     */
    public function getFieldAsDateTime($name)
    {
        return $this->getFieldAsType($name, DateTimeDecorator::class);
    }

    /**
     * @return Reference
     */
    public function getFieldAsReference($name)
    {
        return $this->getFieldAsType($name, Reference::class);
    }

    /**
     * @return Set
     */
    public function getFieldAsBoolSet($name)
    {
        return $this->getFieldAsSetType($name, 'bool');
    }

    /**
     * @return Set
     */
    public function getFieldAsNumberSet($name)
    {
        return $this->getFieldAsSetType($name, 'float');
    }

    /**
     * @return Set
     */
    public function getFieldAsIntegerSet($name)
    {
        return $this->getFieldAsSetType($name, 'int');
    }

    /**
     * @return Set
     */
    public function getFieldAsStringSet($name)
    {
        return $this->getFieldAsSetType($name, 'string');
    }

    /**
     * @return Set
     */
    public function getFieldAsLocalizedStringSet($name)
    {
        return $this->getFieldAsSetType($name, LocalizedString::class);
    }

    /**
     * @return Set
     */
    public function getFieldAsLocalizedEnumSet($name)
    {
        return $this->getFieldAsSetType($name, LocalizedEnum::class);
    }

    /**
     * @return Set
     */
    public function getFieldAsEnumSet($name)
    {
        return $this->getFieldAsSetType($name, Enum::class);
    }

    /**
     * @return Set
     */
    public function getFieldAsMoneySet($name)
    {
        return $this->getFieldAsSetType($name, Money::class);
    }

    /**
     * @return Set
     */
    public function getFieldAsDateSet($name)
    {
        return $this->getFieldAsSetType($name, DateDecorator::class);
    }

    /**
     * @return Set
     */
    public function getFieldAsTimeSet($name)
    {
        return $this->getFieldAsSetType($name, TimeDecorator::class);
    }

    /**
     * @return Set
     */
    public function getFieldAsDateTimeSet($name)
    {
        return $this->getFieldAsSetType($name, DateTimeDecorator::class);
    }

    /**
     * @return Set
     */
    public function getFieldAsReferenceSet($name)
    {
        return $this->getFieldAsSetType($name, Reference::class);
    }

    private function getFieldAsSetType($name, $type)
    {
        $value = $this->get($name);

        if ($value instanceof Set && $value->getType() === $type) {
            return $value;
        }
        return Set::ofTypeAndData($type, $value);
    }

    private function getFieldAsType($name, $type)
    {
        $value = $this->get($name);

        if ($value instanceof $type) {
            return $value;
        }
        if ($this->isDeserializableType($type)) {
            return $type::fromArray($value);
        } else {
            return new $type($value);
        }
    }
}
