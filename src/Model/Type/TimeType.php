<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Type;

/**
 * @package Commercetools\Core\Model\Type
 * @link https://dev.commercetools.com/http-api-projects-types.html#time-type
 * @method string getName()
 * @method TimeType setName(string $name = null)
 */
class TimeType extends FieldType
{
    const NAME = 'Time';

    public function fieldTypeDefinition()
    {
        return [static::TYPE => '\DateTime', static::DECORATOR => '\Commercetools\Core\Model\Common\TimeDecorator'];
    }
}
