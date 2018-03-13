<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Project;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocalizedEnumCollection;

/**
 * @package Commercetools\Core\Model\Project
 * @link https://dev.commercetools.com/http-api-projects-project.html#cartclassification
 * @method string getType()
 * @method CartClassificationType setType(string $type = null)
 * @method LocalizedEnumCollection getValues()
 * @method CartClassificationType setValues(LocalizedEnumCollection $values = null)
 */
class CartClassificationType extends ShippingRateInputType
{
    const INPUT_TYPE = 'CartClassification';

    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string'],
            'values' => [static::TYPE => LocalizedEnumCollection::class]
        ];
    }
}
