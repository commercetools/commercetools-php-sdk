<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts\Command;


use Sphere\Core\Request\AbstractAction;

class CartSetCountryAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'country' => [static::TYPE => 'string'],
        ];
    }

    public function __construct()
    {
        $this->setAction('setCountry');
    }
}
