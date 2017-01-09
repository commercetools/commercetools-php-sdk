<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

use Commercetools\Core\Model\Common\DateDecorator;
use DateTime;

/**
 * @package Commercetools\Core\Model\ProductType
 * @link https://dev.commercetools.com/http-api-projects-productTypes.html#datetype
 * @method string getName()
 * @method DateType setName(string $name = null)
 */
class DateType extends AttributeType
{
    const NAME = 'date';

    public function fieldTypeDefinition()
    {
        return [static::TYPE => DateTime::class, static::DECORATOR => DateDecorator::class];
    }
}
