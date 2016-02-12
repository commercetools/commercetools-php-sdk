<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Order
 * @link https://dev.commercetools.com/http-api-projects-orders-import.html#import-line-item
 * @method LineItemImportDraft current()
 * @method LineItemImportDraftCollection add(LineItemImportDraft $element)
 * @method LineItemImportDraft getAt($offset)
 */
class LineItemImportDraftCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Order\LineItemImportDraft';
}
