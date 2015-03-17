<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products\Command;

use Sphere\Core\Request\AbstractAction;

/**
 * Class ProductPublishAction
 * @package Sphere\Core\Request\Products\Command
 * @method string getAction()
 * @method ProductPublishAction setAction(string $action)
 */
class ProductPublishAction extends AbstractAction
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
        $this->setAction('publish');
    }
}
