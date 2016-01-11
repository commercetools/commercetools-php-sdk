<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Types\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Common\LocalizedString;

/**
 * @package Commercetools\Core\Request\Types\Command
 * @method string getAction()
 * @method TypeChangeNameAction setAction(string $action = null)
 * @method LocalizedString getName()
 * @method TypeChangeNameAction setName(LocalizedString $name = null)
 */
class TypeChangeNameAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'name' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
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
     * @param LocalizedString $name
     * @param Context|callable $context
     * @return TypeChangeNameAction
     */
    public static function ofName(LocalizedString $name, $context = null)
    {
        return static::of($context)->setName($name);
    }
}
