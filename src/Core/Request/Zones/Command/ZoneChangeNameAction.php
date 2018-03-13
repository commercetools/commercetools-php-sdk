<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Zones\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Zones\Command
 * @link https://docs.commercetools.com/http-api-projects-zones.html#change-name
 * @method string getAction()
 * @method ZoneChangeNameAction setAction(string $action = null)
 * @method string getName()
 * @method ZoneChangeNameAction setName(string $name = null)
 */
class ZoneChangeNameAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'name' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeName');
    }


    /**
     * @param string $name
     * @param Context|callable $context
     * @return ZoneChangeNameAction
     */
    public static function ofName($name, $context = null)
    {
        return static::of($context)->setName($name);
    }
}
