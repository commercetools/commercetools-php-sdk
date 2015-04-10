<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\TaxCategory;

use Sphere\Core\Model\Common\JsonObject;

class TaxRate extends JsonObject
{
    public function getFields()
    {
        return [
            'id' => [self::TYPE => 'string'],
            'name' => [self::TYPE => 'string'],
            'amount' => [self::TYPE => 'float'],
            'includedInPrice' => [self::TYPE => 'bool'],
            'country' => [self::TYPE => 'string'],
            'state' => [self::TYPE => 'string']
        ];
    }
}
