<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Carts\Command
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
