<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Product
 * @method getFrom()
 * @method FilterRange setFrom($from = null)
 * @method getTo()
 * @method FilterRange setTo($to = null)
 */
class FilterRange extends JsonObject
{
    const DEFAULT_TYPE = 'int';

    protected $valueType;

    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->valueType = static::DEFAULT_TYPE;
    }

    public function getPropertyDefinitions()
    {
        return [
            'from' => [static::TYPE => $this->valueType],
            'to' => [static::TYPE => $this->valueType]
        ];
    }

    protected function valueToString($value)
    {
        if (is_null($value)) {
            return '*';
        }
        if (is_int($value) || is_float($value)) {
            return $value;
        }
        if (is_string($value)) {
            return '"' . $value . '"';
        }
        if ($value instanceof \DateTime) {
            $decorator = new DateTimeDecorator($value);
            return '"' . $decorator->jsonSerialize() . '"';
        }
        return (string)$value;
    }

    public function __toString()
    {
        return sprintf('(%s to %s)', $this->valueToString($this->getFrom()), $this->valueToString($this->getTo()));
    }

    /**
     * @param string $valueType
     * @return static
     */
    public static function ofType($valueType = null)
    {
        $range = static::of();
        if (!is_null($valueType)) {
            $range->valueType = $valueType;
        }

        return $range;
    }
}
