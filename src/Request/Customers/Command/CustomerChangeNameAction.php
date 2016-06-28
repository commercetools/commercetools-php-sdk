<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Customers\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Customers\Command
 * @deprecated this action has been deprecated by the API, use setFirstName, setLastName, setMiddleName or setTitle
 * @link https://dev.commercetools.com/http-api-projects-customers.html#set-first-name
 * @method string getFirstName()
 * @method string getLastName()
 * @method string getMiddleName()
 * @method string getTitle()
 * @method CustomerChangeNameAction setFirstName(string $firstName = null)
 * @method CustomerChangeNameAction setLastName(string $lastName = null)
 * @method CustomerChangeNameAction setMiddleName(string $middleName = null)
 * @method CustomerChangeNameAction setTitle(string $title = null)
 * @method string getAction()
 * @method CustomerChangeNameAction setAction(string $action = null)
 */
class CustomerChangeNameAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'firstName' => [static::TYPE => 'string'],
            'lastName' => [static::TYPE => 'string'],
            'middleName' => [static::TYPE => 'string'],
            'title' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeName');
    }


    /**
     * @param string $firstName
     * @param string $lastName
     * @param Context|callable $context
     * @return CustomerChangeNameAction
     */
    public static function ofFirstNameAndLastName($firstName, $lastName, $context = null)
    {
        return static::of($context)->setFirstName($firstName)->setLastName($lastName);
    }
}
