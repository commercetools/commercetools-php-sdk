<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products\Command;

use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Request\AbstractAction;

/**
 * Class ProductSetMetaTitleAction
 * @package Sphere\Core\Request\Products\Command
 * @link http://dev.sphere.io/http-api-projects-products.html#set-meta-attributes
 * @method string getAction()
 * @method ProductSetMetaTitleAction setAction(string $action = null)
 * @method LocalizedString getMetaTitle()
 * @method ProductSetMetaTitleAction setMetaTitle(LocalizedString $metaTitle = null)
 */
class ProductSetMetaTitleAction extends AbstractAction
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
