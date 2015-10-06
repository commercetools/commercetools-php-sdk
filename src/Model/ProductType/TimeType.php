<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

/**
 * @package Commercetools\Core\Model\ProductType
 * @method string getName()
 * @method TimeType setName(string $name = null)
 */
class TimeType extends AttributeType
{
    const NAME = 'time';

    public function fieldTypeDefinition()
    {
        return [static::TYPE => '\DateTime', static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'];
    }
}
