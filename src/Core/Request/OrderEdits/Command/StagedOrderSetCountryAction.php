<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\Command;

use Commercetools\Core\Request\Carts\Command\CartSetCountryAction;

/**
 * @package Commercetools\Core\Request\OrderEdits\Command
 *
 * @method string getAction()
 * @method StagedOrderSetCountryAction setAction(string $action = null)
 * @method string getCountry()
 * @method StagedOrderSetCountryAction setCountry(string $country = null)
 */
class StagedOrderSetCountryAction extends CartSetCountryAction implements StagedOrderUpdateAction
{

}
