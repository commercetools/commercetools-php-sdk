<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products\Command;

use Sphere\Core\Request\AbstractAction;

/**
 * Class ProductSetAttributeAction
 * @package Sphere\Core\Request\Products\Command
 * @method string getAction()
 * @method ProductSetAttributeAction setAction(string $action = null)
 * @method int getVariantId()
 * @method ProductSetAttributeAction setVariantId(int $variantId = null)
 * @method string getName()
 * @method ProductSetAttributeAction setName(string $name = null)
 * @method string getValue()
 * @method ProductSetAttributeAction setValue(string $value = null)
 * @method bool getStaged()
 * @method ProductSetAttributeAction setStaged(bool $staged = null)
 */
class ProductSetAttributeAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'variantId' => [static::TYPE => 'int'],
            'name' => [static::TYPE => 'string'],
            'value' => [static::TYPE => 'string'],
            'staged' => [static::TYPE => 'bool'],
        ];
    }

    /**
     * @param int $variantId
     * @param string $name
     */
    public function __construct($variantId, $name)
    {
        $this->setAction('setAttribute');
        $this->setVariantId($variantId);
        $this->setName($name);
    }
}
