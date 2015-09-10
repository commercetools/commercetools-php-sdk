<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Type;

use Commercetools\Core\Model\Common\Context;

/**
 * @package Commercetools\Core\Model\Type
 * @method string getName()
 * @method StringType setName(string $name = null)
 */
class StringType extends FieldType
{
    const NAME = 'String';

    public function fieldTypeDefinition()
    {
        return [static::TYPE => 'string'];
    }
}
