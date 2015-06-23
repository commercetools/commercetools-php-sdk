<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * Class ProductSetAttributeAction
 * @package Sphere\Core\Request\Products\Command
 * @link http://dev.sphere.io/http-api-projects-products.html#set-attribute
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
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setAttribute');
    }

    /**
     * @param int $variantId
     * @param string $name
     * @param Context|callable $context
     * @return ProductSetAttributeAction
     */
    public static function ofVariantIdAndName($variantId, $name, $context = null)
    {
        return static::of($context)->setVariantId($variantId)->setName($name);
    }
}
