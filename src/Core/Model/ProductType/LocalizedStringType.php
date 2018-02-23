<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

use Commercetools\Core\Model\Common\LocalizedString;

/**
 * @package Commercetools\Core\Model\ProductType
 * @link https://docs.commercetools.com/http-api-projects-productTypes.html#localizabletexttype
 * @method string getName()
 * @method LocalizedStringType setName(string $name = null)
 */
class LocalizedStringType extends AttributeType
{
    const NAME = 'ltext';

    public function fieldTypeDefinition()
    {
        return [static::TYPE => LocalizedString::class];
    }
}
