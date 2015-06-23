<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Request\AbstractAction;

/**
 * Class ProductSetDescriptionAction
 * @package Sphere\Core\Request\Products\Command
 * @link http://dev.sphere.io/http-api-projects-products.html#set-description
 * @method string getAction()
 * @method ProductSetDescriptionAction setAction(string $action = null)
 * @method LocalizedString getDescription()
 * @method ProductSetDescriptionAction setDescription(LocalizedString $description = null)
 * @method bool getStaged()
 * @method ProductSetDescriptionAction setStaged(bool $staged = null)
 */
class ProductSetDescriptionAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'description' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
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
        $this->setAction('setDescription');
    }

    /**
     * @param LocalizedString $description
     * @param Context|callable $context
     * @return ProductSetDescriptionAction
     */
    public static function ofDescription(LocalizedString $description, $context = null)
    {
        return static::of($context)->setDescription($description);
    }
}
