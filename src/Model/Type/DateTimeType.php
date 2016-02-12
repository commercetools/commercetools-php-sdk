<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Type;

/**
 * @package Commercetools\Core\Model\Type
 * @link https://dev.commercetools.com/http-api-projects-types.html#datetime-type
 * @method string getName()
 * @method DateTimeType setName(string $name = null)
 */
class DateTimeType extends FieldType
{
    const NAME = 'DateTime';

    public function fieldTypeDefinition()
    {
        return [static::TYPE => '\DateTime', static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'];
    }
}
