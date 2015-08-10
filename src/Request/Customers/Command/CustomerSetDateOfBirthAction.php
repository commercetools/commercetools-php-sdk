<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Customers\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Common\DateDecorator;

/**
 * @package Commercetools\Core\Request\Customers\Command
 * @apidoc http://dev.sphere.io/http-api-projects-customers.html#set-date-of-birth
 * @method DateDecorator getDateOfBirth()
 * @method CustomerSetDateOfBirthAction setDateOfBirth(\DateTime $dateOfBirth = null)
 * @method string getAction()
 * @method CustomerSetDateOfBirthAction setAction(string $action = null)
 */
class CustomerSetDateOfBirthAction extends AbstractAction
{
    public function getPropertyDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'dateOfBirth' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateDecorator'
            ],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setDateOfBirth');
    }
}
