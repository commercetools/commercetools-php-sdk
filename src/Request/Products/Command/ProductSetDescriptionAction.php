<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products\Command;

use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Request\AbstractAction;

/**
 * Class ProductSetDescriptionAction
 * @package Sphere\Core\Request\Products\Command
 * @method string getAction()
 * @method ProductSetDescriptionAction setAction(string $action)
 * @method LocalizedString getDescription()
 * @method ProductSetDescriptionAction setDescription(LocalizedString $description)
 * @method bool getStaged()
 * @method ProductSetDescriptionAction setStaged(bool $staged)
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
     * @param LocalizedString $description
     */
    public function __construct(LocalizedString $description)
    {
        $this->setAction('setDescription');
        $this->setDescription($description);
    }
}
