<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Customers\Command;

use Sphere\Core\Request\AbstractAction;

/**
 * Class CustomerChangeNameAction
 * @package Sphere\Core\Request\Customers\Command
 * @method string getFirstName()
 * @method string getLastName()
 * @method string getMiddleName()
 * @method string getTitle()
 * @method CustomerChangeNameAction setFirstName(string $firstName)
 * @method CustomerChangeNameAction setLastName(string $lastName)
 * @method CustomerChangeNameAction setMiddleName(string $middleName)
 * @method CustomerChangeNameAction setTitle(string $title)
 */
class CustomerChangeNameAction extends AbstractAction
{
    public function getFields()
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
     * @param string $firstName
     * @param string $lastName
     */
    public function __construct($firstName, $lastName)
    {
        $this->setAction('changeName');
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
    }
}
