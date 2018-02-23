<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Categories\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Categories\Command
 * @link https://docs.commercetools.com/http-api-projects-categories.html#change-orderhint
 * @method string getOrderHint()
 * @method CategoryChangeOrderHintAction setOrderHint(string $orderHint = null)
 * @method string getAction()
 * @method CategoryChangeOrderHintAction setAction(string $action = null)
 */
class CategoryChangeOrderHintAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'orderHint' => [static::TYPE => 'string']
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeOrderHint');
    }

    /**
     * @param string $orderHint
     * @param Context|callable $context
     * @return CategoryChangeOrderHintAction
     */
    public static function ofOrderHint($orderHint, $context = null)
    {
        return static::of($context)->setOrderHint($orderHint);
    }
}
