<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Customers\Command;

use Sphere\Core\Request\AbstractAction;

/**
 * Class CustomerChangeNameAction
 * @package Sphere\Core\Request\Customers\Command
 * @method string getExternalId()
 * @method CustomerSetExternalIdAction setExternalId(string $externalId)
 */
class CustomerSetExternalIdAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'externalId' => [static::TYPE => 'string'],
        ];
    }

    public function __construct()
    {
        $this->setAction('setExternalId');
    }
}
