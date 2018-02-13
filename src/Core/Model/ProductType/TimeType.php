<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

use Commercetools\Core\Model\Common\TimeDecorator;
use DateTime;

/**
 * @package Commercetools\Core\Model\ProductType
 * @link https://docs.commercetools.com/http-api-projects-productTypes.html#timetype
 * @method string getName()
 * @method TimeType setName(string $name = null)
 */
class TimeType extends AttributeType
{
    const NAME = 'time';

    public function fieldTypeDefinition()
    {
        return [static::TYPE => DateTime::class, static::DECORATOR => TimeDecorator::class];
    }
}
