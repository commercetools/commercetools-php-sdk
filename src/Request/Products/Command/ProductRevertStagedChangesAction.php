<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products\Command;

use Sphere\Core\Request\AbstractAction;

/**
 * Class ProductRevertStagedChangesAction
 * @package Sphere\Core\Request\Products\Command
 * @link http://dev.sphere.io/http-api-projects-products.html#revert-staged-changes
 * @method string getAction()
 * @method ProductRevertStagedChangesAction setAction(string $action = null)
 */
class ProductRevertStagedChangesAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
        ];
    }

    /**
     *
     */
    public function __construct()
    {
        $this->setAction('revertStagedChanges');
    }
}
