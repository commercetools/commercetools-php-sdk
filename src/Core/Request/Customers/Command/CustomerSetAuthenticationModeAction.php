<?php

namespace Commercetools\Core\Request\Customers\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Customers\Command
 * @link https://docs.commercetools.com/api/projects/customers#set-authenticationmode
 * @method string getAction()
 * @method CustomerSetAuthenticationModeAction setAction(string $action = null)
 * @method string getAuthenticationMode()
 * @method CustomerSetAuthenticationModeAction setAuthenticationMode(string $key = null)
 * @method string getAuthMode()
 * @method CustomerSetAuthenticationModeAction setAuthMode(string $authMode = null)
 * @method string getPassword()
 * @method CustomerSetAuthenticationModeAction setPassword(string $password = null)
 */
class CustomerSetAuthenticationModeAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'authMode' => [static::TYPE => 'string'],
            'password' => [static::TYPE => 'string', static::OPTIONAL => true],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setAuthenticationMode');
    }
}
