<?php

namespace Commercetools\Core\Model\Store;

use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use Commercetools\Core\Model\ProductSelection\ProductSelectionReference;
use DateTime;

/**
 * @package Commercetools\Core\Model\Store
 * @link https://docs.commercetools.com/http-api-projects-stores#store
 * @method ProductSelectionReference getProductSelection()
 * @method ProductSelectionSetting setProductSelection(ProductSelectionReference $productSelection = null)
 * @method bool getActive()
 * @method ProductSelectionSetting setActive(bool $active = null)
 */
class ProductSelectionSetting extends Resource
{
    public function fieldDefinitions()
    {
        return [
            'productSelection' => [static::TYPE => ProductSelectionReference::class],
            'active' => [static::TYPE => 'bool'],
        ];
    }
}
