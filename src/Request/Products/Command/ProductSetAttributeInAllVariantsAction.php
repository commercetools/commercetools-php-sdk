<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products\Command;

use Sphere\Core\Request\AbstractAction;

/**
 * Class ProductSetAttributeInAllVariantsAction
 * @package Sphere\Core\Request\Products\Command
 * @method string getAction()
 * @method ProductSetAttributeInAllVariantsAction setAction(string $action)
 * @method string getName()
 * @method ProductSetAttributeInAllVariantsAction setName(string $name)
 * @method string getValue()
 * @method ProductSetAttributeInAllVariantsAction setValue(string $value)
 * @method bool getStaged()
 * @method ProductSetAttributeInAllVariantsAction setStaged(bool $staged)
 */
class ProductSetAttributeInAllVariantsAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'name' => [static::TYPE => 'string'],
            'value' => [static::TYPE => 'string'],
            'staged' => [static::TYPE => 'bool'],
        ];
    }

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->setAction('setAttributeInAllVariants');
        $this->setName($name);
    }
}
