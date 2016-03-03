<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Customers\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Customers\Command
 * @link http://dev.commercetools.com/http-api-projects-customers.html#set-title
 * @method string getAction()
 * @method CustomerSetTitleNameAction setAction(string $action = null)
 * @method string getTitle()
 * @method CustomerSetTitleNameAction setTitle(string $title = null)
 */
class CustomerSetTitleNameAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'title' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setTitle');
    }
}
