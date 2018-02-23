<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Carts\Command
 * @link https://docs.commercetools.com/http-api-projects-carts.html#recalculate
 * @method string getAction()
 * @method CartRecalculateAction setAction(string $action = null)
 * @method bool getUpdateProductData()
 * @method CartRecalculateAction setUpdateProductData(bool $updateProductData = null)
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

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['updateProductData'] = [static::TYPE => 'bool'];

        return $definitions;
    }
}
