<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Categories\Command;

use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Request\AbstractAction;

/**
 * Class CategorySetDescriptionAction
 * @package Sphere\Core\Request\Categories\Command
 * @link http://dev.sphere.io/http-api-projects-categories.html#set-description
 * @method LocalizedString getDescription()
 * @method CategorySetDescriptionAction setDescription(LocalizedString $description = null)
 * @method string getAction()
 * @method CategorySetDescriptionAction setAction(string $action = null)
 */
class CategorySetDescriptionAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'description' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString']
        ];
    }

    public function __construct(LocalizedString $description)
    {
        $this->setAction('setDescription');
        $this->setDescription($description);
    }
}
