<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\DiscountCodes\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\DiscountCodes\Command
 * @link https://docs.commercetools.com/http-api-projects-discountCodes.html#change-groups
 * @method string getAction()
 * @method DiscountCodeChangeGroupsAction setAction(string $action = null)
 * @method array getGroups()
 * @method DiscountCodeChangeGroupsAction setGroups(array $groups = null)
 */
class DiscountCodeChangeGroupsAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'groups' => [static::TYPE => 'array'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeGroups');
    }

    /**
     * @param array $groups
     * @param Context|callable $context
     * @return DiscountCodeChangeGroupsAction
     */
    public static function ofGroups(array $groups, $context = null)
    {
        return static::of($context)->setGroups($groups);
    }
}
