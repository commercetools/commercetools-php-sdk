<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Carts\Command
 * @link https://docs.commercetools.com/http-api-projects-carts.html#set-deletedaysafterlastmodification-beta
 * @method string getAction()
 * @method CartSetDeleteDaysAfterLastModificationAction setAction(string $action = null)
 * @method int getDeleteDaysAfterLastModification()
 * @codingStandardsIgnoreStart
 * @method CartSetDeleteDaysAfterLastModificationAction setDeleteDaysAfterLastModification(int $deleteDaysAfterLastModification = null)
 * @codingStandardsIgnoreEnd
 */
class CartSetDeleteDaysAfterLastModificationAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'deleteDaysAfterLastModification' => [static::TYPE => 'int'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setDeleteDaysAfterLastModification');
    }

    /**
     * @param int $days
     * @param Context|callable $context
     * @return CartSetDeleteDaysAfterLastModificationAction
     */
    public static function ofDays($days, $context = null)
    {
        return static::of($context)->setDeleteDaysAfterLastModification($days);
    }
}
