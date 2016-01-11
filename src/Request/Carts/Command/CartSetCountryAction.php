<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Carts\Command
 * @apidoc http://dev.sphere.io/http-api-projects-carts.html#set-country
 * @method string getAction()
 * @method CartSetCountryAction setAction(string $action = null)
 * @method string getCountry()
 * @method CartSetCountryAction setCountry(string $country = null)
 */
class CartSetCountryAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'country' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setCountry');
    }
}
