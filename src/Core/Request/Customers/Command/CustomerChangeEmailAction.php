<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Customers\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Customers\Command
 * @link https://docs.commercetools.com/http-api-projects-customers.html#change-email
 * @method string getEmail()
 * @method CustomerChangeEmailAction setEmail(string $email = null)
 * @method string getAction()
 * @method CustomerChangeEmailAction setAction(string $action = null)
 */
class CustomerChangeEmailAction extends AbstractAction
{
    public function fieldDefinitions()
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
