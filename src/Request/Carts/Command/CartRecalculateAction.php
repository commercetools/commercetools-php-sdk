<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts\Command;

use Sphere\Core\Request\AbstractAction;

/**
 * Class CartRecalculateAction
 * @package Sphere\Core\Request\Carts\Command
 * @link http://dev.sphere.io/http-api-projects-carts.html#recalculate
 * @method string getAction()
 * @method CartRecalculateAction setAction(string $action = null)
 */
class CartRecalculateAction extends AbstractAction
{

    public function __construct()
    {
        $this->setAction('recalculate');
    }
}
