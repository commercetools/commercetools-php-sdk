<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Categories\Command;

use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Request\AbstractAction;

/**
 * Class CategorySetMetaTitleAction
 * @package Sphere\Core\Request\Categories\Command
 * @link http://dev.sphere.io/http-api-projects-products.html#set-meta-attributes
 * @method string getAction()
 * @method CategorySetMetaTitleAction setAction(string $action = null)
 * @method LocalizedString getMetaTitle()
 * @method CategorySetMetaTitleAction setMetaTitle(LocalizedString $metaTitle = null)
 */
class CategorySetMetaTitleAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'metaTitle' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
        ];
    }

    /**
     *
     */
    public function __construct()
    {
        $this->setAction('setMetaTitle');
    }
}
