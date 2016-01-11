<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

/**
 * @package Commercetools\Core\Model\ProductType
 * @method string getName()
 * @method DateTimeType setName(string $name = null)
 */
class DateTimeType extends AttributeType
{
    const NAME = 'datetime';

    public function fieldTypeDefinition()
    {
        return [static::TYPE => '\DateTime', static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'];
    }
}
