<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Channels\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Channels\Command
 * @link https://docs.commercetools.com/http-api-projects-channels.html#set-roles
 * @method string getAction()
 * @method ChannelSetRolesAction setAction(string $action = null)
 * @method array getRoles()
 * @method ChannelSetRolesAction setRoles(array $roles = null)
 */
class ChannelSetRolesAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'roles' => [static::TYPE => 'array'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setRoles');
    }

    /**
     * @param array $roles
     * @param Context|callable $context
     * @return ChannelSetRolesAction
     */
    public static function ofRoles(array $roles, $context = null)
    {
        return static::of($context)->setRoles($roles);
    }
}
