<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products\Command;

use Sphere\Core\Request\AbstractAction;

/**
 * Class ProductRemoveVariantAction
 * @package Sphere\Core\Request\Products\Command
 * @method string getAction()
 * @method ProductRemoveVariantAction setAction(string $action = null)
 * @method int getId()
 * @method ProductRemoveVariantAction setId(int $id = null)
 * @method bool getStaged()
 * @method ProductRemoveVariantAction setStaged(bool $staged = null)
 */
class ProductRemoveVariantAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'id' => [static::TYPE => 'int'],
            'staged' => [static::TYPE => 'bool'],
        ];
    }

    /**
     * @param int $id
     */
    public function __construct($id)
    {
        $this->setAction('removeVariant');
        $this->setId($id);
    }
}
