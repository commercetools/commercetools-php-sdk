<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Channels\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Channels\Command
 * @link https://dev.commercetools.com/http-api-projects-channels.html#remove-roles
 * @method string getAction()
 * @method ChannelRemoveRolesAction setAction(string $action = null)
 * @method array getRoles()
 * @method ChannelRemoveRolesAction setRoles(array $roles = null)
 */
class ChannelRemoveRolesAction extends AbstractAction
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
        $this->setAction('removeRoles');
    }

    /**
     * @param array $roles
     * @param Context|callable $context
     * @return ChannelRemoveRolesAction
     */
    public static function ofRoles(array $roles, $context = null)
    {
        return static::of($context)->setRoles($roles);
    }
}
