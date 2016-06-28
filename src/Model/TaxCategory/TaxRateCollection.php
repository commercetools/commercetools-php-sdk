<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\TaxCategory;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\TaxCategory
 * @link https://dev.commercetools.com/http-api-projects-taxCategories.html#taxrate
 * @method TaxRate current()
 * @method TaxRateCollection add(TaxRate $element)
 * @method TaxRate getAt($offset)
 */
class TaxRateCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\TaxCategory\TaxRate';

    protected function indexRow($offset, $row)
    {
        $id = null;
        if ($row instanceof TaxRate) {
            $id = $row->getId();
        } elseif (is_array($row)) {
            $id = isset($row[static::ID]) ? $row[static::ID] : null;
        }
        $this->addToIndex(static::ID, $offset, $id);
    }
}
