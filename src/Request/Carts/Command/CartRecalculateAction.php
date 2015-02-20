<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts\Command;


use Sphere\Core\Request\AbstractAction;

class CartRecalculateAction extends AbstractAction
{

    public function __construct()
    {
        $this->setAction('recalculate');
    }
}
