<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Request\AbstractAction;

/**
 * Class ProductChangeNameAction
 * @package Sphere\Core\Request\Products\Command
 * @link http://dev.sphere.io/http-api-projects-products.html#change-name
 * @method string getAction()
 * @method ProductChangeNameAction setAction(string $action = null)
 * @method LocalizedString getName()
 * @method ProductChangeNameAction setName(LocalizedString $name = null)
 * @method bool getStaged()
 * @method ProductChangeNameAction setStaged(bool $staged = null)
 */
class ProductChangeNameAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'name' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
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
        $this->setAction('changeName');
    }

    /**
     * @param LocalizedString $name
     * @param Context|callable $context
     * @return ProductChangeNameAction
     */
    public static function ofName(LocalizedString $name, $context = null)
    {
        return static::of($context)->setName($name);
    }
}
