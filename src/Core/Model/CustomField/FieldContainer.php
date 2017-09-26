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
        $value = $this->get($name);

        if ($value instanceof LocalizedString) {
            return $value;
        }
        return LocalizedString::fromArray($value);
    }

    /**
     * @return LocalizedEnum
     */
    public function getFieldAsLocalizedEnum($name)
    {
        $value = $this->get($name);

        if ($value instanceof LocalizedEnum) {
            return $value;
        }
        return LocalizedEnum::fromArray($value);
    }

    /**
     * @return Enum
     */
    public function getFieldAsEnum($name)
    {
        $value = $this->get($name);

        if ($value instanceof Enum) {
            return $value;
        }
        return Enum::fromArray($value);
    }

    /**
     * @return Money
     */
    public function getFieldAsMoney($name)
    {
        $value = $this->get($name);

        if ($value instanceof Money) {
            return $value;
        }
        return Money::fromArray($value);
    }

    /**
     * @return DateDecorator
     */
    public function getFieldAsDate($name)
    {
        $value = $this->get($name);

        if ($value instanceof DateDecorator) {
            return $value;
        }
        return new DateDecorator($value);
    }

    /**
     * @return TimeDecorator
     */
    public function getFieldAsTime($name)
    {
        $value = $this->get($name);

        if ($value instanceof TimeDecorator) {
            return $value;
        }
        return new TimeDecorator($value);
    }

    /**
     * @return DateTimeDecorator
     */
    public function getFieldAsDateTime($name)
    {
        $value = $this->get($name);

        if ($value instanceof DateTimeDecorator) {
            return $value;
        }
        return new DateTimeDecorator($value);
    }

    /**
     * @return Reference
     */
    public function getFieldAsReference($name)
    {
        $value = $this->get($name);

        if ($value instanceof Reference) {
            return $value;
        }
        return Reference::fromArray($value);
    }

    /**
     * @return Set
     */
    public function getFieldAsBoolSet($name)
    {
        $value = $this->get($name);

        if ($value instanceof Set && $value->getType() == 'bool') {
            return $value;
        }
        return Set::ofTypeAndData('bool', $value);
    }

    /**
     * @return Set
     */
    public function getFieldAsNumberSet($name)
    {
        $value = $this->get($name);

        if ($value instanceof Set && $value->getType() == 'float') {
            return $value;
        }
        return Set::ofTypeAndData('float', $value);
    }

    /**
     * @return Set
     */
    public function getFieldAsIntegerSet($name)
    {
        $value = $this->get($name);

        if ($value instanceof Set && $value->getType() == 'int') {
            return $value;
        }
        return Set::ofTypeAndData('int', $value);
    }

    /**
     * @return Set
     */
    public function getFieldAsStringSet($name)
    {
        $value = $this->get($name);

        if ($value instanceof Set && $value->getType() == 'string') {
            return $value;
        }
        return Set::ofTypeAndData('string', $value);
    }

    /**
     * @return Set
     */
    public function getFieldAsLocalizedStringSet($name)
    {
        $value = $this->get($name);

        if ($value instanceof Set && $value->getType() == LocalizedString::class) {
            return $value;
        }
        return Set::ofTypeAndData(LocalizedString::class, $value);
    }

    /**
     * @return Set
     */
    public function getFieldAsLocalizedEnumSet($name)
    {
        $value = $this->get($name);

        if ($value instanceof Set && $value->getType() == LocalizedEnum::class) {
            return $value;
        }
        return Set::ofTypeAndData(LocalizedEnum::class, $value);
    }

    /**
     * @return Set
     */
    public function getFieldAsEnumSet($name)
    {
        $value = $this->get($name);

        if ($value instanceof Set && $value->getType() == Enum::class) {
            return $value;
        }
        return Set::ofTypeAndData(Enum::class, $value);
    }

    /**
     * @return Set
     */
    public function getFieldAsMoneySet($name)
    {
        $value = $this->get($name);

        if ($value instanceof Set && $value->getType() == Money::class) {
            return $value;
        }
        return Set::ofTypeAndData(Money::class, $value);
    }

    /**
     * @return Set
     */
    public function getFieldAsDateSet($name)
    {
        $value = $this->get($name);

        if ($value instanceof Set && $value->getType() == DateDecorator::class) {
            return $value;
        }
        return Set::ofTypeAndData(DateDecorator::class, $value);
    }

    /**
     * @return Set
     */
    public function getFieldAsTimeSet($name)
    {
        $value = $this->get($name);

        if ($value instanceof Set && $value->getType() == TimeDecorator::class) {
            return $value;
        }
        return Set::ofTypeAndData(TimeDecorator::class, $value);
    }

    /**
     * @return Set
     */
    public function getFieldAsDateTimeSet($name)
    {
        $value = $this->get($name);

        if ($value instanceof Set && $value->getType() == DateTimeDecorator::class) {
            return $value;
        }
        return Set::ofTypeAndData(DateTimeDecorator::class, $value);
    }

    /**
     * @return Set
     */
    public function getFieldAsReferenceSet($name)
    {
        $value = $this->get($name);

        if ($value instanceof Set && $value->getType() == Reference::class) {
            return $value;
        }
        return Set::ofTypeAndData(Reference::class, $value);
    }
}
