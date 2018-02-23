<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;

/**
 * @package Commercetools\Core\Model\ProductType
 * @link https://docs.commercetools.com/http-api-projects-productTypes.html#datetimetype
 * @method string getName()
 * @method DateTimeType setName(string $name = null)
 */
class DateTimeType extends AttributeType
{
    const NAME = 'datetime';

    public function fieldTypeDefinition()
    {
        return [static::TYPE => DateTime::class, static::DECORATOR => DateTimeDecorator::class];
    }
}
