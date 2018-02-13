<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Type;

use Commercetools\Core\Model\Common\DateDecorator;
use DateTime;

/**
 * @package Commercetools\Core\Model\Type
 * @link https://docs.commercetools.com/http-api-projects-types.html#datetype
 * @method string getName()
 * @method DateType setName(string $name = null)
 */
class DateType extends FieldType
{
    const NAME = 'Date';

    public function fieldTypeDefinition()
    {
        return [static::TYPE => DateTime::class, static::DECORATOR => DateDecorator::class];
    }
}
