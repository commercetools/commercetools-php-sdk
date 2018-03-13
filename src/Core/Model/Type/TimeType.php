<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Type;

use Commercetools\Core\Model\Common\TimeDecorator;
use DateTime;

/**
 * @package Commercetools\Core\Model\Type
 * @link https://docs.commercetools.com/http-api-projects-types.html#timetype
 * @method string getName()
 * @method TimeType setName(string $name = null)
 */
class TimeType extends FieldType
{
    const NAME = 'Time';

    public function fieldTypeDefinition()
    {
        return [static::TYPE => DateTime::class, static::DECORATOR => TimeDecorator::class];
    }
}
