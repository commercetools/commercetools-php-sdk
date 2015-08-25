<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Type;


/**
 * @package Commercetools\Core\Model\Type
 * @method string getName()
 * @method LocalizedStringType setName(string $name = null)
 */
class LocalizedStringType extends FieldType
{
    const NAME = 'LocalizedString';

    public function fieldTypeDefinition()
    {
        return [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'];
    }
}
