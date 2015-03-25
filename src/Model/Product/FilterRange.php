<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Product;

use Sphere\Core\Model\Common\JsonObject;

/**
 * Class FilterRange
 * @package Sphere\Core\Model\Product
 * @method getFrom()
 * @method FilterRange setFrom($from = null)
 * @method getTo()
 * @method FilterRange setTo($to = null)
 */
class FilterRange extends JsonObject
{
    protected $valueType;

    public function __construct($valueType)
    {
        $this->valueType = $valueType;
    }

    public function getFields()
    {
        return [
            'from' => [static::TYPE => $this->valueType],
            'to' => [static::TYPE => $this->valueType]
        ];
    }

    protected function mapValue($value)
    {
        var_dump($value);
        if (is_null($value)) {
            return '*';
        }
        return $value;
    }

    public function __toString()
    {
        return sprintf('(%s to %s)', $this->mapValue($this->getFrom()), $this->mapValue($this->getTo()));
    }
}
