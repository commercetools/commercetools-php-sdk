<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Channels\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * @package Sphere\Core\Request\Channels\Command
 * 
 * @method string getAction()
 * @method ChannelAddRolesAction setAction(string $action = null)
 * @method array getRoles()
 * @method ChannelAddRolesAction setRoles(array $roles = null)
 */
class ChannelAddRolesAction extends AbstractAction
{
    public function getFields()
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
        $this->setAction('addRoles');
    }

    /**
     * @param array $roles
     * @param Context|callable $context
     * @return ChannelAddRolesAction
     */
    public static function ofRoles(array $roles, $context = null)
    {
        return static::of($context)->setRoles($roles);
    }
}
