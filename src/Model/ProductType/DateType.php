<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

/**
 * @package Commercetools\Core\Model\ProductType
 * @link https://dev.commercetools.com/http-api-projects-productTypes.html#date-type
 * @method string getName()
 * @method DateType setName(string $name = null)
 */
class DateType extends AttributeType
{
    const NAME = 'date';

    public function fieldTypeDefinition()
    {
        return [static::TYPE => '\DateTime', static::DECORATOR => '\Commercetools\Core\Model\Common\DateDecorator'];
    }
}
