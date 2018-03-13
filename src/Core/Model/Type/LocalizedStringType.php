<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Type;

use Commercetools\Core\Model\Common\LocalizedString;

/**
 * @package Commercetools\Core\Model\Type
 * @link https://docs.commercetools.com/http-api-projects-types.html#localizedstringtype
 * @method string getName()
 * @method LocalizedStringType setName(string $name = null)
 */
class LocalizedStringType extends FieldType
{
    const NAME = 'LocalizedString';

    public function fieldTypeDefinition()
    {
        return [static::TYPE => LocalizedString::class];
    }
}
