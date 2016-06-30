<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

/**
 * @package Commercetools\Core\Model\ProductType
 * @link https://dev.commercetools.com/http-api-projects-productTypes.html#localizabletexttype
 * @method string getName()
 * @method LocalizedStringType setName(string $name = null)
 */
class LocalizedStringType extends AttributeType
{
    const NAME = 'ltext';

    public function fieldTypeDefinition()
    {
        return [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'];
    }
}
