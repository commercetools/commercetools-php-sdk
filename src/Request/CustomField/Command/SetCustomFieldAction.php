<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CustomField\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\CustomField\Command
 *
 * @method string getAction()
 * @method SetCustomFieldAction setAction(string $action = null)
 * @method string getName()
 * @method SetCustomFieldAction setName(string $name = null)
 * @method getValue()
 * @method SetCustomFieldAction setValue($value = null)
 */
class SetCustomFieldAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'name' => [static::TYPE => 'string'],
            'value' => [static::TYPE => null],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setCustomField');
    }

    /**
     * @param $name
     * @param Context|callable $context
     * @return SetCustomFieldAction
     */
    public static function ofName($name, $context = null)
    {
        return static::of($context)->setName($name);
    }
}
