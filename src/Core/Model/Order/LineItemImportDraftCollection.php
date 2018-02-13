<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Order
 * @link https://docs.commercetools.com/http-api-projects-orders-import.html#lineitemimportdraft
 * @method LineItemImportDraft current()
 * @method LineItemImportDraftCollection add(LineItemImportDraft $element)
 * @method LineItemImportDraft getAt($offset)
 */
class LineItemImportDraftCollection extends Collection
{
    protected $type = LineItemImportDraft::class;
}
