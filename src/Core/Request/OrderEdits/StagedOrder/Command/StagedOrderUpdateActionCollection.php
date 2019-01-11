<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method StagedOrderUpdateActionCollection add(StagedOrderUpdateAction $element)
 * @method StagedOrderUpdateAction current()
 * @method StagedOrderUpdateAction getAt($offset)
 */
class StagedOrderUpdateActionCollection extends Collection
{
    protected $type = StagedOrderUpdateAction::class;
}
