<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductTypes\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ProductTypes\Command
 * 
 * @method string getAction()
 * @method ProductTypeChangeDescriptionAction setAction(string $action = null)
 * @method string getDescription()
 * @method ProductTypeChangeDescriptionAction setDescription(string $description = null)
 */
class ProductTypeChangeDescriptionAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'description' => [static::TYPE => 'string']
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeDescription');
    }

    /**
     * @param string $description
     * @param Context|callable $context
     * @return ProductTypeChangeDescriptionAction
     */
    public static function ofDescription($description, $context = null)
    {
        return static::of($context)->setDescription($description);
    }
}
