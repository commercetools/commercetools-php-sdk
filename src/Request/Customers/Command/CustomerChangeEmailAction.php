<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Customers\Command;

use Sphere\Core\Request\AbstractAction;

/**
 * Class CustomerChangeEmailAction
 * @package Sphere\Core\Request\Customers\Command
 * @method string getEmail()
 * @method CustomerChangeEmailAction setEmail(string $email)
 * @method string getAction()
 * @method CustomerChangeEmailAction setAction(string $action)
 */
class CustomerChangeEmailAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'email' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param string $email
     */
    public function __construct($email)
    {
        $this->setAction('changeEmail');
        $this->setEmail($email);
    }
}
