<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * @package Sphere\Core\Request\Carts\Command
 * @apidoc http://dev.sphere.io/http-api-projects-carts.html#recalculate
 * @method string getAction()
 * @method CartRecalculateAction setAction(string $action = null)
 */
class CartRecalculateAction extends AbstractAction
{
    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('recalculate');
    }
}
