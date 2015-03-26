<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Customers\Command;

use Sphere\Core\Request\AbstractAction;

/**
 * Class CustomerSetDateOfBirthAction
 * @package Sphere\Core\Request\Customers\Command
 * @method \DateTime getDateOfBirth()
 * @method CustomerSetDateOfBirthAction setDateOfBirth(\DateTime $dateOfBirth = null)
 * @method string getAction()
 * @method CustomerSetDateOfBirthAction setAction(string $action = null)
 */
class CustomerSetDateOfBirthAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'dateOfBirth' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Sphere\Core\Model\Common\DateDecorator'
            ],
        ];
    }

    public function __construct()
    {
        $this->setAction('setDateOfBirth');
    }
}
