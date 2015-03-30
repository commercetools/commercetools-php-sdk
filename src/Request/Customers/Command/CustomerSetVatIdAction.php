<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Customers\Command;

use Sphere\Core\Request\AbstractAction;

/**
 * Class CustomerSetVatIdAction
 * @package Sphere\Core\Request\Customers\Command
 * @method string getVatId()
 * @method CustomerSetVatIdAction setVatId(string $vatId = null)
 * @method string getAction()
 * @method CustomerSetVatIdAction setAction(string $action = null)
 */
class CustomerSetVatIdAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'vatId' => [static::TYPE => 'string'],
        ];
    }

    public function __construct()
    {
        $this->setAction('setVatId');
    }
}
