<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Customers\Command;

use Sphere\Core\Request\AbstractAction;

/**
 * Class CustomerChangeNameAction
 * @package Sphere\Core\Request\Customers\Command
 * @method string getVatId()
 * @method CustomerSetVatIdAction setExternalId(string $vatId)
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
