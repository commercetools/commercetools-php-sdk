<?php
/**
 */

namespace Commercetools\Core\Request\Stores\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Common\LocalizedString;

/**
 * @package Commercetools\Core\Request\Stores\Command
 * @link https://docs.commercetools.com/http-api-projects-stores#set-name
 * @method string getAction()
 * @method StoreSetNameAction setAction(string $action = null)
 * @method LocalizedString getName()
 * @method StoreSetNameAction setName(LocalizedString $name = null)
 */
class StoreSetNameAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'name' => [static::TYPE => LocalizedString::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setName');
    }
}
