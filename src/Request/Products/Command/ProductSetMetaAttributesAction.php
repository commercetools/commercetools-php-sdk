<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products\Command;

use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Request\AbstractAction;

/**
 * Class ProductSetMetaAttributesAction
 * @package Sphere\Core\Request\Products\Command
 * @method string getAction()
 * @method ProductSetMetaAttributesAction setAction(string $action)
 * @method LocalizedString getMetaTitle()
 * @method ProductSetMetaAttributesAction setMetaTitle(LocalizedString $metaTitle)
 * @method LocalizedString getMetaDescription()
 * @method ProductSetMetaAttributesAction setMetaDescription(LocalizedString $metaDescription)
 * @method LocalizedString getMetaKeywords()
 * @method ProductSetMetaAttributesAction setMetaKeywords(LocalizedString $metaKeywords)
 * @method bool getStaged()
 * @method ProductSetMetaAttributesAction setStaged(bool $staged)
 */
class ProductSetMetaAttributesAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'metaTitle' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'metaDescription' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'metaKeywords' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'staged' => [static::TYPE => 'bool'],
        ];
    }

    /**
     *
     */
    public function __construct()
    {
        $this->setAction('setMetaAttributes');
    }
}
