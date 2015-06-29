<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Customers\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * Class CustomerChangeEmailAction
 * @package Sphere\Core\Request\Customers\Command
 * @link http://dev.sphere.io/http-api-projects-customers.html#change-email
 * @method string getEmail()
 * @method CustomerChangeEmailAction setEmail(string $email = null)
 * @method string getAction()
 * @method CustomerChangeEmailAction setAction(string $action = null)
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
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeEmail');
    }


    /**
     * @param $email
     * @param Context|callable $context
     * @return CustomerChangeEmailAction
     */
    public static function ofEmail($email, $context = null)
    {
        return static::of($context)->setEmail($email);
    }
}
