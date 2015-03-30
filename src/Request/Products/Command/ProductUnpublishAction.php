<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products\Command;

use Sphere\Core\Request\AbstractAction;

/**
 * Class ProductUnpublishAction
 * @package Sphere\Core\Request\Products\Command
 * @method string getAction()
 * @method ProductUnpublishAction setAction(string $action = null)
 */
class ProductUnpublishAction extends AbstractAction
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
        $this->setAction('unpublish');
    }
}
