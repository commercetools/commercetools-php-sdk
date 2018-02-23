<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\States\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\States\Command
 * @link https://docs.commercetools.com/http-api-projects-states.html#remove-state-roles
 * @method string getAction()
 * @method StateRemoveRolesAction setAction(string $action = null)
 * @method array getRoles()
 * @method StateRemoveRolesAction setRoles(array $roles = null)
 */
class StateRemoveRolesAction extends AbstractAction
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
     * @return StateRemoveRolesAction
     */
    public static function ofRoles(array $roles, $context = null)
    {
        return static::of($context)->setRoles($roles);
    }
}
