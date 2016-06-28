<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Type;

/**
 * @package Commercetools\Core\Model\Type
 * @link https://dev.commercetools.com/http-api-projects-types.html#datetype
 * @method string getName()
 * @method DateType setName(string $name = null)
 */
class DateType extends FieldType
{
    const NAME = 'Date';

    public function fieldTypeDefinition()
    {
        return [static::TYPE => '\DateTime', static::DECORATOR => '\Commercetools\Core\Model\Common\DateDecorator'];
    }
}
