<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts\Command;

use Sphere\Core\Request\AbstractAction;

/**
 * Class CartSetCountryAction
 * @package Sphere\Core\Request\Carts\Command
 * @method string getAction()
 * @method CartSetCountryAction setAction(string $action)
 * @method string getCountry()
 * @method CartSetCountryAction setCountry(string $country)
 */
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
